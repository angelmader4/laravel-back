<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Proyecto;

use App\GraphQL\Inputs\CreateProyectoInput;
use App\Models\Proyecto;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;


class CreateProyectoMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createProyecto',
        'description' => 'Create a new proyecto'
    ];

    public function type(): Type
    {
        return \GraphQL::type('GeneralOut');
    }

    public function args(): array
    {
        return [
            'input' => [
                'type' => Type::nonNull(\GraphQL::type('CreateProyectoInput')),
                'description' => 'The proyecto data'
            ]
        ];
    }

    public function resolve($root, $args)
    {
        try {
            $input = $args['input'];
            
            $validator = validator($input, [
                'nombre' => 'required|string|max:100',
                'prefijo' => 'nullable|string|max:10',
                'descripcion' => 'nullable|string|max:500',
                'enabled' => 'boolean'
            ]);
    
            if ($validator->fails()) {
                return [
                    'success' => false,
                    'message' => $validator->errors()->first()
                ];
            }
            
            Proyecto::create([
                'nombre' => $input['nombre'],
                'prefijo' => $input['prefijo'] ?? null,
                'descripcion' => $input['descripcion'] ?? null,
                'enabled' => $input['enabled'] ?? true
            ]);

            return [
                'success' => true,
                'message' => 'Proyecto creado exitosamente'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error al crear el proyecto: ' . $e->getMessage()
            ];
        }
    }
} 
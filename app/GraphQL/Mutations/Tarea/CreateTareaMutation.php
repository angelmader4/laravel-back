<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Tarea;

use App\GraphQL\Inputs\CreateTareaInput;
use App\Models\Tarea;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use App\Models\FkProyectoTarea;
use App\Models\FkTareaUsuario;

class CreateTareaMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createTarea',
        'description' => 'Create a new tarea'
    ];

    public function type(): Type
    {
        return \GraphQL::type('GeneralOut');
    }

    public function args(): array
    {
        return [
            'input' => [
                'type' => Type::nonNull(\GraphQL::type('CreateTareaInput')),
                'description' => 'The tarea data'
            ]
        ];
    }

    public function resolve($root, $args)
    {
        try {
            $input = $args['input'];
            $validator = validator($input, [
                'nombre' => 'required|string|max:100',
                'descripcion' => 'nullable|string|max:500',
                'enabled' => 'boolean',
                'proyecto' => 'required|integer|exists:proyectos,id',
                'usuario' => 'required|integer|exists:users,id'
            ]);
    
            if ($validator->fails()) {
                return [
                    'success' => false,
                    'message' => $validator->errors()->first()
                ];
            }
            
            $tarea = Tarea::create([
                'nombre' => $input['nombre'],
                'descripcion' => $input['descripcion'] ?? null,
                'enabled' => $input['enabled'] ?? true
            ]);

            FkProyectoTarea::create([
                'id_proyecto' => $input['proyecto'],
                'id_tarea' => $tarea->id
            ]);

            FkTareaUsuario::create([
                'id_tarea' => $tarea->id,
                'id_usuario' => $input['usuario'] 
            ]);

            return [
                'success' => true,
                'message' => 'Tarea creada exitosamente'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error al crear el proyecto: ' . $e->getMessage()
            ];
        }
    }
} 
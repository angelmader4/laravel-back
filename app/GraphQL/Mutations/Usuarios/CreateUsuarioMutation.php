<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Usuarios;

use App\GraphQL\Inputs\CreateUsuarioInput;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use App\Models\User;
use App\Models\FkUsuariosProyectos;
use Illuminate\Support\Facades\Hash;

class CreateUsuarioMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createUsuario',
        'description' => 'Create a new usuario'
    ];

    public function type(): Type
    {
        return \GraphQL::type('GeneralOut');
    }

    public function args(): array
    {
        return [
            'input' => [
                'type' => Type::nonNull(\GraphQL::type('CreateUsuarioInput')),
                'description' => 'The usuario data'
            ]
        ];
    }

    public function resolve($root, $args)
    {
        try {
            $input = $args['input'];
            
            $validator = validator($input, [
                'nombre' => 'required|string|max:100',
                'cargo' => 'required|string|max:100',
                'rol' => 'required|integer|exists:roles,id',
                'proyecto' => 'required|array',
                'enabled' => 'boolean'
            ]);
    
            if ($validator->fails()) {
                return [
                    'success' => false,
                    'message' => $validator->errors()->first()
                ];
            }
            
            $user = User::create([
                'name' => $input['nombre'],
                'cargo' => $input['cargo'],
                'email' => $input['email'],
                'password' => Hash::make('admin123'),
                'enabled' => $input['enabled'] ?? true,
                'rol' => $input['rol']
            ]);

            foreach ($input['proyecto'] as $proyecto) {
                FkUsuariosProyectos::create([
                    'user_id' => $user->id,
                    'proyecto_id' => $proyecto
                ]);
            }

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
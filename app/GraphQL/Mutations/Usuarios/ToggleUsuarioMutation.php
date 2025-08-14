<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Usuarios;

use App\GraphQL\Inputs\CreateUsuarioInput;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ToggleUsuarioMutation extends Mutation
{
    protected $attributes = [
        'name' => 'toggleUsuario',
        'description' => 'Toggle a usuario'
    ];

    public function type(): Type
    {
        return GraphQL::type('GeneralOut');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'The proyecto id'
            ]
        ];
    }

    public function resolve($root, $args)
    {
        try {
            $usuario = User::find($args['id']);
            $usuario->enabled = !$usuario->enabled;
            $usuario->save();
            
            return [
                'success' => true,
                'message' => 'Cambio de estado realizado exitosamente'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error al crear el proyecto: ' . $e->getMessage()
            ];
        }
    }
} 
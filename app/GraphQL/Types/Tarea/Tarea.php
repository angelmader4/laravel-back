<?php

declare(strict_types=1);

namespace App\GraphQL\Types\Tarea;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class Tarea extends GraphQLType
{
    protected $attributes = [
        'name' => 'Tarea',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'The tarea id'
            ],
            'nombre' => [
                'type' => Type::string(),
                'description' => 'The tarea nombre'
            ],
            'descripcion' => [
                'type' => Type::string(),
                'description' => 'The tarea descripcion'
            ],
            'enabled' => [
                'type' => Type::boolean(),
                'description' => 'The tarea enabled'
            ],
            'proyecto_id' => [
                'type' => Type::int(),
                'description' => 'The tarea proyecto id'
            ],
            'proyecto' => [
                'type' => GraphQL::type('Proyecto'),
                'description' => 'The tarea proyecto'
            ],
            'usuario_id' => [
                'type' => Type::int(),
                'description' => 'The tarea usuario id'
            ],
            'usuario' => [
                'type' => GraphQL::type('Usuario'),
                'description' => 'The tarea usuario'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The tarea created at'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The tarea updated at'
            ],
        ];
    }
    
    protected function resolveProyectoField($root, $args)
    {
        return $root->proyecto()->first();
    }

    protected function resolveUsuarioField($root, $args)
    {
        return $root->usuario()->first();
    }
    
}

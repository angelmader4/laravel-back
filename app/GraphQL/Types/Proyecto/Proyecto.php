<?php

declare(strict_types=1);

namespace App\GraphQL\Types\Proyecto;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;

class Proyecto extends GraphQLType
{
    protected $attributes = [
        'name' => 'Proyecto',
        'description' => 'A type',
        'model' => \App\Models\Proyecto::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'The id of the proyecto'
            ],
            'nombre' => [
                'type' => Type::string(),
                'description' => 'The name of the proyecto'
            ],
            'prefijo' => [
                'type' => Type::string(),
                'description' => 'The prefix of the proyecto'
            ],
            'descripcion' => [
                'type' => Type::string(),
                'description' => 'The description of the proyecto'
            ],
            'usuarios' => [
                'type' => Type::listOf(GraphQL::type('Usuario')),
                'description' => 'The usuarios of the proyecto'
            ],
            'enabled' => [
                'type' => Type::boolean(),
                'description' => 'The enabled status of the proyecto'
            ],
        ];
    }
}

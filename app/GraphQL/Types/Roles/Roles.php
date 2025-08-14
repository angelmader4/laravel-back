<?php

declare(strict_types=1);

namespace App\GraphQL\Types\Roles;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class Roles extends GraphQLType
{
    protected $attributes = [
        'name' => 'Roles',
        'description' => 'A type',
        'model' => \App\Models\Roles::class
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
            'enabled' => [
                'type' => Type::boolean(),
                'description' => 'The enabled status of the proyecto'
            ],
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class GeneralOut extends GraphQLType
{
    protected $attributes = [
        'name' => 'GeneralOut',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'success' => [
                'type' => Type::boolean(),
                'description' => 'Whether the operation was successful'
            ],
            'message' => [
                'type' => Type::string(),
                'description' => 'A message describing the result'
            ]
        ];
    }
}

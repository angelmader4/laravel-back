<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class CreateProyectoInput extends InputType
{
    protected $attributes = [
        'name' => 'CreateProyectoInput',
        'description' => 'Input type for creating a new proyecto'
    ];

    public function fields(): array
    {
        return [
            'nombre' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the proyecto (required)',
                'rules' => ['required', 'string', 'max:100']
            ],
            'prefijo' => [
                'type' => Type::string(),
                'description' => 'The prefix of the proyecto (optional)',
                'rules' => ['nullable', 'string', 'max:10']
            ],
            'descripcion' => [
                'type' => Type::string(),
                'description' => 'The description of the proyecto (optional)',
                'rules' => ['nullable', 'string', 'max:500']
            ],
            'enabled' => [
                'type' => Type::boolean(),
                'description' => 'The enabled status of the proyecto (defaults to true)',
                'defaultValue' => true,
                'rules' => ['boolean']
            ]
        ];
    }
} 
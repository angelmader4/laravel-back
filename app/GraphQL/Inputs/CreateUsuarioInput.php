<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class CreateUsuarioInput extends InputType
{
    protected $attributes = [
        'name' => 'CreateUsuarioInput',
        'description' => 'Input type for creating a new usuario'
    ];

    public function fields(): array
    {
        return [
            'nombre' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the usuario (required)',
                'rules' => ['required', 'string', 'max:100']
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of the usuario (required)',
                'rules' => ['required', 'string', 'email', 'max:100']
            ],
            'cargo' => [
                'type' => Type::string(),
                'description' => 'The cargo of the usuario',
                'rules' => ['required', 'string', 'max:100']
            ],
            'rol' => [
                'type' => Type::int(),
                'description' => 'The rol of the usuario',
                'rules' => ['required', 'integer', 'exists:roles,id']
            ],
            'proyecto' => [
                'type' => Type::listOf(Type::int()),
                'description' => 'The proyecto of the usuario',
                'rules' => ['required', 'array', 'exists:proyectos,id']
            ],
            'enabled' => [
                'type' => Type::boolean(),
                'description' => 'The enabled status of the usuario',
                'rules' => ['required', 'boolean']
            ]
        ];
    }
} 
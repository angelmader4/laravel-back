<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class CreateTareaInput extends InputType
{
    protected $attributes = [
        'name' => 'CreateTareaInput',
        'description' => 'Input type for creating a new tarea'
    ];

    public function fields(): array
    {
        return [
            'nombre' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the proyecto (required)',
                'rules' => ['required', 'string', 'max:100']
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
            ],
            'proyecto' => [
                'type' => Type::int(),
                'description' => 'The proyecto of the tarea (required)',
                'rules' => ['required', 'integer', 'exists:proyectos,id']
            ],
            'usuario' => [
                'type' => Type::int(),
                'description' => 'The usuario of the tarea (required)',
                'rules' => ['required', 'integer', 'exists:users,id']
            ]

        ];
    }
} 
<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class UpdateProyectoInput extends InputType
{
    protected $attributes = [
        'name' => 'UpdateProyectoInput',
        'description' => 'Input type for updating an existing proyecto'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The ID of the proyecto to update (required)',
                'rules' => ['required', 'integer', 'exists:proyectos,id']
            ],
            'nombre' => [
                'type' => Type::string(),
                'description' => 'The name of the proyecto (optional)',
                'rules' => ['nullable', 'string', 'max:100']
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
                'description' => 'The enabled status of the proyecto (optional)',
                'rules' => ['nullable', 'boolean']
            ]
        ];
    }
} 
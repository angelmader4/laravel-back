<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Tarea;

use App\GraphQL\Inputs\UpdateTareaInput;
use App\Models\Tarea;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;


class ToggleTareaMutation extends Mutation
{
    protected $attributes = [
        'name' => 'toggleTarea',
        'description' => 'Toggle a tarea'
    ];

    public function type(): Type
    {
        return \GraphQL::type('GeneralOut');
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
            $tarea = Tarea::find($args['id']);
            $tarea->enabled = !$tarea->enabled;
            $tarea->save();
            
            return [
                'success' => true,
                'message' => 'Cambio de estado realizado exitosamente'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error al crear la tarea: ' . $e->getMessage()
            ];
        }
    }
} 
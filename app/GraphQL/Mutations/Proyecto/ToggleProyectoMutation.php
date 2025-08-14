<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Proyecto;

use App\GraphQL\Inputs\CreateProyectoInput;
use App\Models\Proyecto;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;


class ToggleProyectoMutation extends Mutation
{
    protected $attributes = [
        'name' => 'toggleProyecto',
        'description' => 'Toggle a proyecto'
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
            $proyecto = Proyecto::find($args['id']);
            $proyecto->enabled = !$proyecto->enabled;
            $proyecto->save();
            
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
<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Proyecto;

use App\GraphQL\Inputs\UpdateProyectoInput;
use App\Models\Proyecto;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class UpdateProyectoMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateProyecto',
        'description' => 'Update an existing proyecto'
    ];

    public function type(): Type
    {
        return \GraphQL::type('GeneralOut');
    }

    public function args(): array
    {
        return [
            'input' => [
                'type' => Type::nonNull(\GraphQL::type('UpdateProyectoInput')),
                'description' => 'The proyecto update data'
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $input = $args['input'];        
        
        $validator = validator($input, [
            'id' => 'required|integer|exists:proyectos,id',
            'nombre' => 'nullable|string|max:100',
            'prefijo' => 'nullable|string|max:10',
            'descripcion' => 'nullable|string|max:500',
            'enabled' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => $validator->errors()->first()
            ];
        }

        $proyecto = Proyecto::find($input['id']);
        
        if (!$proyecto) {
            return [
                'success' => false,
                'message' => 'Proyecto no encontrado'
            ];
        }

        try {
            $updateData = [];
            if (isset($input['nombre'])) $updateData['nombre'] = $input['nombre'];
            if (isset($input['prefijo'])) $updateData['prefijo'] = $input['prefijo'];
            if (isset($input['descripcion'])) $updateData['descripcion'] = $input['descripcion'];
            if (isset($input['enabled'])) $updateData['enabled'] = $input['enabled'];

            $proyecto->update($updateData);

            return [
                'success' => true,
                'message' => 'Proyecto actualizado exitosamente'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error al actualizar el proyecto: ' . $e->getMessage()
            ];
        }
    }
} 
<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Tarea;

use App\GraphQL\Inputs\UpdateTareaInput;
use App\Models\Tarea;
use App\Models\FkProyectoTarea;
use App\Models\FkTareaUsuario;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class UpdateTareaMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateTarea',
        'description' => 'Update an existing tarea'
    ];

    public function type(): Type
    {
        return \GraphQL::type('GeneralOut');
    }

    public function args(): array
    {
        return [
            'input' => [
                'type' => Type::nonNull(\GraphQL::type('UpdateTareaInput')),
                'description' => 'The tarea update data'
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $input = $args['input'];        
        
        $validator = validator($input, [
            'id' => 'required|integer|exists:tarea,id',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:500',
            'enabled' => 'boolean',
            'proyecto' => 'required|integer|exists:proyectos,id',
            'usuario' => 'required|integer|exists:users,id'
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => $validator->errors()->first()
            ];
        }

        $tarea = Tarea::find($input['id']);
        
        if (!$tarea) {
            return [
                'success' => false,
                'message' => 'Tarea no encontrada'
            ];
        }

        try {
            $updateData = [];
            if (isset($input['nombre'])) $updateData['nombre'] = $input['nombre'];
            if (isset($input['descripcion'])) $updateData['descripcion'] = $input['descripcion'];
            if (isset($input['enabled'])) $updateData['enabled'] = $input['enabled'];

            $tarea->update($updateData);



            FkProyectoTarea::where('id_tarea', $tarea->id)->delete();
            FkProyectoTarea::create([
                'id_proyecto' => $input['proyecto'],
                'id_tarea' => $tarea->id
            ]);

            FkTareaUsuario::where('id_tarea', $tarea->id)->delete();
            FkTareaUsuario::create([
                'id_usuario' => $input['usuario'],
                'id_tarea' => $tarea->id
            ]);

            return [
                'success' => true,
                'message' => 'Tarea actualizada exitosamente'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error al actualizar la tarea: ' . $e->getMessage()
            ];
        }
    }
} 
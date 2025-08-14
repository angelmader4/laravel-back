<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Usuarios;

use App\GraphQL\Inputs\UpdateUsuarioInput;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

use App\Models\User;
use App\Models\FkUsuariosProyectos;


class UpdateUsuarioMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateUsuario',
        'description' => 'Update an existing usuario'
    ];

    public function type(): Type
    {
        return \GraphQL::type('GeneralOut');
    }

    public function args(): array
    {
        return [
            'input' => [
                'type' => Type::nonNull(GraphQL::type('UpdateUsuarioInput')),
                'description' => 'The usuario update data'
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $input = $args['input'];        
        
        $validator = validator($input, [
            'id' => 'required|integer|exists:users,id',
            'nombre' => 'nullable|string|max:100',
            'email' => 'nullable|string|max:100',
            'cargo' => 'nullable|string|max:100',
            'rol' => 'nullable|integer|exists:roles,id',
            'proyecto' => 'nullable|array',
            'enabled' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => $validator->errors()->first()
            ];
        }

        $user = User::find($input['id']);
        
        if (!$user) {
            return [
                'success' => false,
                'message' => 'Usuario no encontrado'
            ];
        }

        try {
            $updateData = [];
            if (isset($input['nombre'])) $updateData['name'] = $input['nombre'];
            if (isset($input['email'])) $updateData['email'] = $input['email'];
            if (isset($input['cargo'])) $updateData['cargo'] = $input['cargo'];
            if (isset($input['rol'])) $updateData['rol'] = $input['rol'];
            if (isset($input['enabled'])) $updateData['enabled'] = $input['enabled'];
            $user->update($updateData);

            FkUsuariosProyectos::where('user_id', $user->id)->delete();
            foreach ($input['proyecto'] as $proyecto) {
                FkUsuariosProyectos::create([
                    'user_id' => $user->id,
                    'proyecto_id' => $proyecto
                ]);
            }

            return [
                'success' => true,
                'message' => 'Usuario actualizado exitosamente'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error al actualizar el usuario: ' . $e->getMessage()
            ];
        }
    }
} 
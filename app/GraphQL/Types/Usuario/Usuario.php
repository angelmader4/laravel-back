<?php

declare(strict_types=1);

namespace App\GraphQL\Types\Usuario;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;

class Usuario extends GraphQLType
{
    protected $attributes = [
        'name' => 'Usuario',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'The usuario id'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The usuario nombre'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The usuario email'
            ],
            'enabled' => [
                'type' => Type::boolean(),
                'description' => 'The usuario enabled'
            ],
            'rol_user' => [
                'type' => \GraphQL::type('Roles'),
                'description' => 'The usuario rol'
            ],
            'proyectos' => [
                'type' => Type::listOf(GraphQL::type('Proyecto')),
                'description' => 'The usuario proyectos'
            ],
            'cargo' => [
                'type' => Type::string(),
                'description' => 'The usuario cargo'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The usuario created at'
            ],
        ];
    }

    public function resolveRolUser($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return $root->rol_user;
    }

    public function resolveProyectos($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return $root->proyectos()->get();
    }

}

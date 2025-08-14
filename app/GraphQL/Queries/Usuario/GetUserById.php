<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\Usuario;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Models\User;


class GetUserById extends Query
{
    protected $attributes = [
        'name' => 'getUsuario',
        'description' => 'Get a usuario by id'
    ];

    public function type(): Type
    {
        return GraphQL::type('Usuario');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'rules' => ['required', 'exists:users,id']
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        return User::with($fields->getRelations())->find($args['id']);
    }
}

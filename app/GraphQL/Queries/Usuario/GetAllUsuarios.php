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

class GetAllUsuarios extends Query
{
    protected $attributes = [
        'name' => 'getAllUsuarios',
        'description' => 'Get all usuarios'
    ];

    public function type(): Type
    {
        return GraphQL::paginate('Usuario');
    }

    public function args(): array
    {
        return [
            'page' => [
                'type' => Type::int(),
                'default' => 1
            ],
            'perPage' => [
                'type' => Type::int(),
                'default' => 10
            ],
            'enabled' => [
                'type' => Type::boolean(),
                'default' => null
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $query = User::with($fields->getRelations())->orderBy('id', 'desc');

        if (isset($args['enabled'])) {
            $query->where('enabled', $args['enabled']);
        }

        return $query->paginate($args['perPage'], ['*'], 'page', $args['page']);
    }
}

<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\Tarea;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Models\Tarea;

class GetAllTareaQuery extends Query
{
    protected $attributes = [
        'name' => 'getAllTarea',
        'description' => 'Get all tarea'
    ];

    public function type(): Type
    {
        return GraphQL::paginate('Tarea');
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
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        return Tarea::orderBy('id', 'desc')->paginate($args['perPage'], ['*'], 'page', $args['page']);
    }
}

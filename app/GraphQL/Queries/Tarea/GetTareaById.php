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

class GetTareaById extends Query
{
    protected $attributes = [
        'name' => 'getTarea',
        'description' => 'Get a tarea by id'
    ];

    public function type(): Type
    {
        return GraphQL::type('Tarea');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'The id of the tarea'
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        return Tarea::find($args['id']);
    }
}

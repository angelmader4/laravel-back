<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\Proyecto;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\Proyecto;

class GetByIdQuery extends Query
{
    protected $attributes = [
        'name' => 'GetByIdQueryGetById',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return \GraphQL::type('Proyecto');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        return Proyecto::find($args['id']);
    }
}

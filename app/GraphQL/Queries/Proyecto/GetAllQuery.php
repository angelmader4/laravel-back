<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\Proyecto;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Models\Proyecto;

class GetAllQuery extends Query
{
    protected $attributes = [
        'name' => 'getAllProyectos',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return GraphQL::paginate('Proyecto');
    }

    public function args(): array
    {
        return [
            'page' => [
                'type' => Type::int(),
                'default' => 1,
            ],
            'perPage' => [
                'type' => Type::int(),
                'default' => 10,
            ],
            'search' => [
                'type' => Type::string(),
                'default' => null
            ],
            'enabled' => [
                'type' => Type::boolean(),
                'default' => null
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $query = Proyecto::orderBy('id', 'desc');

        if (isset($args['enabled'])) {
            $query->where('enabled', $args['enabled']);
        }

        if (isset($args['search'])) {
            $query->where('prefijo', 'like', '%' . $args['search'] . '%')
                ->orWhere('descripcion', 'like', '%' . $args['search'] . '%')
                ->orWhere('nombre', 'like', '%' . $args['search'] . '%');
        }

        return $query->paginate($args['perPage'], ['*'], 'page', $args['page']);
    }
}

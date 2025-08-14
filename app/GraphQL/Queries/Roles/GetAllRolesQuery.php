<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\Roles;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Models\Roles;

class GetAllRolesQuery extends Query
{
    protected $attributes = [
        'name' => 'getAllRoles',
        'description' => 'Get all roles'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Roles'));
    }

    public function args(): array
    {
        return [];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return Roles::all();
    }
}

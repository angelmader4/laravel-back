<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class TestQuery extends Query
{
    protected $attributes = [
        'name' => 'test',
        'description' => 'Query de prueba simple'
    ];

    public function type(): Type
    {
        return Type::string();
    }

    public function args(): array
    {
        return [];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return '¡GraphQL está funcionando!';
    }
} 
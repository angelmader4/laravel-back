<?php

return [
    /*
    |--------------------------------------------------------------------------
    | GraphQL Endpoint
    |--------------------------------------------------------------------------
    |
    | The endpoint where GraphQL queries can be sent.
    |
    */
    'endpoint' => env('GRAPHQL_ENDPOINT', '/graphql'),

    /*
    |--------------------------------------------------------------------------
    | GraphiQL Endpoint
    |--------------------------------------------------------------------------
    |
    | The endpoint where GraphiQL interface can be accessed.
    |
    */
    'graphiql_endpoint' => env('GRAPHIQL_ENDPOINT', '/graphiql'),

    /*
    |--------------------------------------------------------------------------
    | Schema Path
    |--------------------------------------------------------------------------
    |
    | Path to the GraphQL schema file.
    |
    */
    'schema_path' => app_path('GraphQL/Schemas/schema.graphql'),

    /*
    |--------------------------------------------------------------------------
    | Controllers Namespace
    |--------------------------------------------------------------------------
    |
    | Namespace for GraphQL controllers.
    |
    */
    'controllers_namespace' => 'App\\GraphQL\\Controllers',

    /*
    |--------------------------------------------------------------------------
    | Types Namespace
    |--------------------------------------------------------------------------
    |
    | Namespace for GraphQL types.
    |
    */
    'types_namespace' => 'App\\GraphQL\\Types',

    /*
    |--------------------------------------------------------------------------
    | Queries Namespace
    |--------------------------------------------------------------------------
    |
    | Namespace for GraphQL queries.
    |
    */
    'queries_namespace' => 'App\\GraphQL\\Queries',

    /*
    |--------------------------------------------------------------------------
    | Mutations Namespace
    |--------------------------------------------------------------------------
    |
    | Namespace for GraphQL mutations.
    |
    */
    'mutations_namespace' => 'App\\GraphQL\\Mutations',

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Middleware to apply to GraphQL routes.
    |
    */
    'middleware' => [
        'api',
        // 'auth:sanctum', // Comentado temporalmente para desarrollo
    ],

    /*
    |--------------------------------------------------------------------------
    | Debug Mode
    |--------------------------------------------------------------------------
    |
    | Enable debug mode for development.
    |
    */
    'debug' => env('APP_DEBUG', false),

    'default_schema' => 'default',
    'schemas' => [
        'default' => [
            'query' => [
                'test' => App\GraphQL\Queries\TestQuery::class,
                'getAllProyectos' => App\GraphQL\Queries\Proyecto\GetAllQuery::class,
                'getProyecto' => App\GraphQL\Queries\Proyecto\GetByIdQuery::class,
                'getAllTareas' => App\GraphQL\Queries\Tarea\GetAllTareaQuery::class,
                'getAllRoles' => App\GraphQL\Queries\Roles\GetAllRolesQuery::class,
                'getAllUsuarios' => App\GraphQL\Queries\Usuario\GetAllUsuarios::class,
                'getUsuario' => App\GraphQL\Queries\Usuario\GetUserById::class,
                'getTarea' => App\GraphQL\Queries\Tarea\GetTareaById::class,
                // 'getTarifaById' => App\GraphQL\Queries\Tarifa\GetById::class,
                // 'getAllTarifa' => App\GraphQL\Queries\Tarifa\GetAllQuery::class,
            ],
            'mutation' => [
                'createProyecto' => App\GraphQL\Mutations\Proyecto\CreateProyectoMutation::class,
                'updateProyecto' => App\GraphQL\Mutations\Proyecto\UpdateProyectoMutation::class,
                'toggleProyecto' => App\GraphQL\Mutations\Proyecto\ToggleProyectoMutation::class,

                'createUsuario' => App\GraphQL\Mutations\Usuarios\CreateUsuarioMutation::class,
                'updateUsuario' => App\GraphQL\Mutations\Usuarios\UpdateUsuarioMutation::class,
                'toggleUsuario' => App\GraphQL\Mutations\Usuarios\ToggleUsuarioMutation::class,


                'createTareas' => App\GraphQL\Mutations\Tarea\CreateTareaMutation::class,
                'updateTareas' => App\GraphQL\Mutations\Tarea\UpdateTareaMutation::class,
                'toggleTareas' => App\GraphQL\Mutations\Tarea\ToggleTareaMutation::class,
            ],
            'types' => [
                'Proyecto' => App\GraphQL\Types\Proyecto\Proyecto::class,
                'GeneralOut' => App\GraphQL\Types\GeneralOut::class,
                'Tarea' => App\GraphQL\Types\Tarea\Tarea::class,
                'Usuario' => App\GraphQL\Types\Usuario\Usuario::class,
                'Roles' => App\GraphQL\Types\Roles\Roles::class,
                
                'CreateProyectoInput' => App\GraphQL\Inputs\CreateProyectoInput::class,
                'UpdateProyectoInput' => App\GraphQL\Inputs\UpdateProyectoInput::class,

                'CreateUsuarioInput' => App\GraphQL\Inputs\CreateUsuarioInput::class,
                'UpdateUsuarioInput' => App\GraphQL\Inputs\UpdateUsuarioInput::class,

                'CreateTareaInput' => App\GraphQL\Inputs\CreateTareaInput::class,
                'UpdateTareaInput' => App\GraphQL\Inputs\UpdateTareaInput::class,
            ],
        ],
    ],
]; 
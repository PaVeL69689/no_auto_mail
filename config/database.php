<?php
return [
    'default' => env('DB_CONNECTION', 'pgsql'),
    'connections' => [
        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', 'postgres'),
            'port' => env('DB_PORT', 5432),
            'database' => env('DB_DATABASE', 'postgresql'),
            'username' => env('DB_USERNAME', 'postgresql'),
            'password' => env('DB_PASSWORD', '6666'),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
        ],
        
    ],
    'redis' => [
        'client' => env('REDIS_CLIENT', 'predis'),
        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DB', 0),
        ],
    ],
];

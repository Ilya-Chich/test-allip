<?php

use Illuminate\Support\Str;

return [

    'default' => env('DB_CONNECTION', 'local'),
    'connections' => [
        'local' => [
            'driver' => env('DB_DRIVER'),
            'host' => env('DB_HOST'),
            'port' => env('DB_PORT'),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'unix_socket' => env('DB_SOCKET'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'timezone' => env('DB_TIMEZONE', '+03:00'),
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        'chitai' => [
            'driver' => env('DB_CHITAI_DRIVER'),
            'host' => env('DB_CHITAI_HOST'),
            'port' => env('DB_CHITAI_PORT'),
            'database' => env('DB_CHITAI_DATABASE'),
            'username' => env('DB_CHITAI_USERNAME'),
            'password' => env('DB_CHITAI_PASSWORD'),
            'unix_socket' => env('DB_CHITAI_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'timezone' => env('DB_CHITAI_TIMEZONE', '+03:00'),
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        'internal_checks' => [
            'driver' => env('DB_INTERNAL_CHECKS_DRIVER'),
            'host' => env('DB_INTERNAL_CHECKS_HOST'),
            'port' => env('DB_INTERNAL_CHECKS_PORT'),
            'database' => env('DB_INTERNAL_CHECKS_DATABASE'),
            'username' => env('DB_INTERNAL_CHECKS_USERNAME'),
            'password' => env('DB_INTERNAL_CHECKS_PASSWORD'),
            'unix_socket' => env('DB_INTERNAL_CHECKS_SOCKET', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],
        'internal_discount' => [
            'driver' => env('DB_INTERNAL_DISCOUNT_DRIVER'),
            'host' => env('DB_INTERNAL_DISCOUNT_HOST'),
            'port' => env('DB_INTERNAL_DISCOUNT_PORT'),
            'database' => env('DB_INTERNAL_DISCOUNT_DATABASE'),
            'username' => env('DB_INTERNAL_DISCOUNT_USERNAME'),
            'password' => env('DB_INTERNAL_DISCOUNT_PASSWORD'),
            'unix_socket' => env('DB_INTERNAL_DISCOUNT_SOCKET', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

    ],
    'migrations' => 'migrations',
    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_') . '_database_'),
        ],
        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],
        'cache' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
            'timeout' => env('REDIS_TIMEOUT'),
        ],
        'site_session' => [
            'host' => env('REDIS_SITE_SESSION_HOST'),
            'port' => env('REDIS_SITE_SESSION_PORT'),
            'password' => env('REDIS_SITE_SESSION_PASSWORD'),
            'database' => env('REDIS_SITE_SESSION_DATABASE'),
            'timeout' => env('REDIS_SITE_SESSION_TIMEOUT'),
            'options' => [
                'prefix' => null,
            ]
        ],
        'site_cache' => [
            'host' => env('REDIS_SITE_CACHE_HOST'),
            'port' => env('REDIS_SITE_CACHE_PORT'),
            'password' => env('REDIS_SITE_CACHE_PASSWORD'),
            'database' => env('REDIS_SITE_CACHE_DATABASE'),
            'timeout' => env('REDIS_CACHE_SITE_TIMEOUT'),
            'options' => [
                'prefix' => null,
            ]
        ],
        'site_analytics' => [
            'host' => env('REDIS_SITE_ANALYTICS_HOST'),
            'port' => env('REDIS_SITE_ANALYTICS_PORT'),
            'password' => env('REDIS_SITE_ANALYTICS_PASSWORD'),
            'database' => env('REDIS_SITE_ANALYTICS_DATABASE'),
            'timeout' => env('REDIS_SITE_ANALYTICS_TIMEOUT'),
            'options' => [
                'prefix' => null,
            ]
        ],

    ],

];

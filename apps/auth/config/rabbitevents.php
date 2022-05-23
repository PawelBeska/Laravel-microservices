<?php

use Enqueue\AmqpTools\RabbitMqDlxDelayStrategy;

return [

    /*
    |--------------------------------------------------------------------------
    | RabbitEvents Connection Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may define the RabbitMQ connection settings that should be used
    | by RabbitEvents. Note that `vhost` should be created by you manually.
    | @see https://www.rabbitmq.com/vhosts.html for more info
    |
    */

    'default' => env('RABBITMQ_CONNECTION', 'rabbitmq'),
    'connections' => [
        'rabbitmq' => [
            'driver' => 'rabbitmq',
            'exchange' => env('RABBITMQ_EXCHANGE', 'events'),
            'host' => env('RABBITMQ_HOST', 'rabbitmq'),
            'port' => env('RABBITMQ_PORT', 5672),
            'user' => env('RABBITMQ_USER', 'guest'),
            'pass' => env('RABBITMQ_PASSWORD', 'guest'),
            'vhost' => env('RABBITMQ_VHOST', 'events'),
            'delay_strategy' => env('RABBITMQ_DELAY_STRATEGY', RabbitMqDlxDelayStrategy::class),
            'ssl' => [
                'is_enabled' => env('RABBITMQ_SSL_ENABLED', false),
                'verify_peer' => env('RABBITMQ_SSL_VERIFY_PEER', true),
                'cafile' => env('RABBITMQ_SSL_CAFILE'),
                'local_cert' => env('RABBITMQ_SSL_LOCAL_CERT'),
                'local_key' => env('RABBITMQ_SSL_LOCAL_KEY'),
                'passphrase' => env('RABBITMQ_SSL_PASSPHRASE', ''),
            ],
        ],
    ],
    'logging' => [
        'enabled' => env('RABBITMQ_LOG_ENABLED', false),
        'level' => env('RABBITMQ_LOG_LEVEL', 'info'),
    ],
];

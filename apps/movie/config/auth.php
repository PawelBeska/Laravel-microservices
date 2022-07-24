<?php
return [
    'defaults' => [
        'guard' => 'redis',
        'passwords' => 'users',
    ],
    'guards' => [
        'redis' => [
            'driver' => 'redis',
            'provider' => 'redis',
        ],
    ],
    'providers' => [
        'redis' => [
            'driver' => 'redis'
        ],
    ],
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],
    'password_timeout' => 10800,
];


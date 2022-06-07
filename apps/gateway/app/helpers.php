<?php

use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Routing\Router;

function reportError(Throwable $exception): void
{
    Log::error(
        $exception->getMessage()
        . PHP_EOL . 'IN LINE: ' . $exception->getLine()
        . PHP_EOL . 'IN FILE: ' . $exception->getFile()
    );
}

function apiResource(Router $router, string $action, string $permission)
{
    $router->get('/', ['uses' => "$action@index", 'middleware' => ["permission:$permission.read"]]);
    $router->get('/{id}', ['uses' => "$action@show", 'middleware' => ["permission:$permission.read"]]);
    $router->post('/', ['uses' => "$action@store", 'middleware' => ["permission:$permission.create"]]);
    $router->delete('/{id}', ['uses' => "$action@destroy", 'middleware' => ["permission:$permission.delete"]]);
    $router->patch('/{id}', ['uses' => "$action@update", 'middleware' => ["permission:$permission.update"]]);
}



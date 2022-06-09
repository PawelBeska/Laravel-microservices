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

function apiResource(Router $router, string $action, string $permission, string $parameter)
{
    $router->get('/', ['uses' => "$action@index", 'middleware' => ["permission:$permission.read"]]);
    $router->get('/{'.$parameter.'}', ['uses' => "$action@show", 'middleware' => ["permission:$permission.read"]]);
    $router->post('/', ['uses' => "$action@store", 'middleware' => ["permission:$permission.create"]]);
    $router->delete('/{'.$parameter.'}', ['uses' => "$action@destroy", 'middleware' => ["permission:$permission.delete"]]);
    $router->put('/{'.$parameter.'}', ['uses' => "$action@update", 'middleware' => ["permission:$permission.update"]]);
}



<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$router->post('/auth/login', "v1\\AuthController@login");
$router->post('/auth/register', "v1\\AuthController@register");

$router->group([
    'middleware' => ["auth"]
], function ($router) {

    // PROFILE SECTION
    $router->group(['prefix' => 'profile/'], function ($router) {
        $router->get('/', "v1\\ProfileController@index");
    });

    // USER SECTION
    $router->group(['prefix' => 'user/'], function ($router) {
        apiResource($router,'v1\\UserController','user');
    });

    // PERMISSION SECTION
    $router->group(['prefix' => 'permission/'], function ($router) {
        apiResource($router,'v1\\PermissionController','permission');
    });

    // ROLE SECTION
    $router->group(['prefix' => 'role/'], function ($router) {
        apiResource($router,'v1\\RoleController','role');
    });


});

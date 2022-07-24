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
    $router->group(['prefix' => 'users/'], function ($router) {
        apiResource($router, 'v1\\UserController', 'user', 'user');
    });

    // PERMISSION SECTION
    $router->group(['prefix' => 'permissions/'], function ($router) {
        apiResource($router, 'v1\\PermissionController', 'permission', 'permission');
    });

    // ROLE SECTION
    $router->group(['prefix' => 'roles/'], function ($router) {
        apiResource($router, 'v1\\RoleController', 'role', 'role');
    });

    // NOTIFICATION TEMPLATES SECTION
    $router->group(['prefix' => 'notification-templates/'], function ($router) {
        apiResource($router, 'v1\\RoleController', 'notification-template', 'notificationTemplate');
    });

    // ROUTE STATISTICS SECTION
    $router->group(['prefix' => 'route-statistics/'], function ($router) {
        $router->get('/', ['uses' => "v1\\RouteStatisticController@index", 'middleware' => ["permission:route_statistics.read"]]);
        $router->get('/{routeStatistics}', ['uses' => "v1\\RouteStatisticController@show", 'middleware' => ["permission:route_statistics.read"]]);
    });


});

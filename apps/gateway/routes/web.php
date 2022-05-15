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

use App\Http\Controllers\v1\UserController;

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
        $router->get('/', "v1\\UserController@index");
    });

    // PERMISSION SECTION
    $router->group(['prefix' => 'permission/'], function ($router) {
        $router->get('/', ['uses' => "v1\\PermissionController" . '@index', 'middleware' => ["permission:permission.read"]]);
    });
});

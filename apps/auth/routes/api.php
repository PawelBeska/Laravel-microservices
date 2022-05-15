<?php

use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\PermissionController;
use App\Http\Controllers\v1\ProfileController;
use App\Http\Controllers\v1\RoleController;
use App\Http\Controllers\v1\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('profile')->group(static function () {
        Route::get('/', [ProfileController::class, 'index']);
    });
    Route::apiResource('role', RoleController::class);
    Route::apiResource('permission', PermissionController::class);
});


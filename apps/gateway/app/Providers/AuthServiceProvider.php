<?php

namespace App\Providers;

use App\Models\User;
use App\Services\Auth\RedisGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        Auth::provider('redis', static function ($app, array $config) {
            return new RedisUserProvider();
        });

        Auth::extend('redis', static function ($app, $name, array $config) {
            return new RedisGuard(Auth::createUserProvider($config['provider']), $app->make('request'));
        });


    }
}

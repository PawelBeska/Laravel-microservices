<?php

namespace App\Providers;

use App\Models\NotificationTemplate;
use App\Policies\NotificationTemplatePolicy;
use App\Services\Auth\RedisGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        NotificationTemplate::class => NotificationTemplatePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Auth::provider('redis', static function ($app, array $config) {
            return new RedisUserProvider();
        });

        Auth::extend('redis', static function ($app, $name, array $config) {
            return new RedisGuard(Auth::createUserProvider($config['provider']), $app->make('request'));
        });
    }
}

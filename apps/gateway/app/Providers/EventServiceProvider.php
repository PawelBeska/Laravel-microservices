<?php

namespace App\Providers;

use App\Events\UserRegisteredEvent;
use App\Jobs\ExampleJob;
use App\Listeners\UserRegisteredListener;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserRegisteredEvent::class => [
            UserRegisteredListener::class,
        ]
    ];

    public function boot(){
        $this->app->bind(
            ExampleJob::class . "@handle",
            fn($job) => $job->handle());
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return true;
    }
}

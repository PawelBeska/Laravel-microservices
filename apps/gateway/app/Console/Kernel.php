<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;
use RabbitEvents\Foundation\Commands\InstallCommand;
use RabbitEvents\Listener\Commands\EventsListCommand;
use RabbitEvents\Listener\Commands\ListenCommand;
use RabbitEvents\Publisher\Commands\ObserverMakeCommand;
use Sammyjo20\SaloonLaravel\Console\Commands\MakeAuthenticator;
use Sammyjo20\SaloonLaravel\Console\Commands\MakeConnector;
use Sammyjo20\SaloonLaravel\Console\Commands\MakePlugin;
use Sammyjo20\SaloonLaravel\Console\Commands\MakeRequest;
use Sammyjo20\SaloonLaravel\Console\Commands\MakeResponse;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

        MakeAuthenticator::class,
        MakeConnector::class,
        MakePlugin::class,
        MakeRequest::class,
        MakeResponse::class,
        InstallCommand::class,
        EventsListCommand::class,
        ObserverMakeCommand::class,
        ListenCommand::class,


    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}

<?php

namespace App\Console;

use App\Console\Commands\GatewayInstallCommand;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;
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
        GatewayInstallCommand::class


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

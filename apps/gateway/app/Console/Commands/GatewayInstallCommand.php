<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GatewayInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gateway:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installing aplication';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call("rabbitmq:exchange-declare application-x --type fanout");

        Artisan::call("rabbitmq:queue-declare auth_queue");
        Artisan::call("rabbitmq:queue-declare gateway_queue");

        Artisan::call("rabbitmq:queue-bind auth_queue application-x");
        Artisan::call("rabbitmq:queue-bind gateway_queue application-x");
    }
}

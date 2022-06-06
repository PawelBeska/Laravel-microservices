<?php

namespace App\Console\Commands;

use App\Enum\RabbitmqHandlerEnum;
use App\Jobs\RabbitCalledJob;
use App\Services\RabbitMQService;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Jobs\UserRegisteredJob;

class TestJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        RabbitMQService::dispatch(
            UserRegisteredJob::class,
            RabbitmqHandlerEnum::JOB,
            [
                'data' => "data",
            ],
        );
        return 1;
    }
}

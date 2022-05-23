<?php

namespace App\Console\Commands;

use App\Jobs\RabbitCalledJob;
use App\Services\RabbitMQService;
use Illuminate\Console\Command;

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
        RabbitMQService::runJob(RabbitCalledJob::class,['test'=>true]);
    }
}

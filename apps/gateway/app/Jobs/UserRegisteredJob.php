<?php

namespace App\Jobs;

use App\Interfaces\RabbitJobInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UserRegisteredJob implements ShouldQueue, RabbitJobInterface
{
    use  InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(...$data): void
    {
        Log::info(1);
        ray($data)->green();
    }
}

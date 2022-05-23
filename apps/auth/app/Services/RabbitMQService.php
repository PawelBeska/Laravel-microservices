<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Support\Facades\Queue;

class RabbitMQService
{

    /**
     * @param string $job
     * @param array $data
     * @param \Carbon\Carbon|null $delay
     * @return void
     * @throws \JsonException
     */
    public static function runJob(
        string  $job,
        array   $data = [],
        ?Carbon $delay = null
    ): void
    {
        Queue::connection('rabbitmq')->pushRaw(json_encode([
            "job" => $job,
            "delay" => $delay,
            ...$data
        ], JSON_THROW_ON_ERROR), config('queue.connections.rabbitmq.queue'), [
            'exchange' => config('queue.connections.rabbitmq.options.exchange.name'),
            'exchange_type' => config('queue.connections.rabbitmq.exchange.type'),
        ]);
    }


}

<?php

namespace App\Services;

use App\Enum\RabbitmqHandlerEnum;
use Carbon\Carbon;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;

class RabbitMQService
{

    /**
     * @param string $action
     * @param \App\Enum\RabbitmqHandlerEnum $type
     * @param array $data
     * @param \Carbon\Carbon|null $delay
     * @return void
     * @throws \JsonException
     */
    public static function dispatch(
        string              $action,
        RabbitmqHandlerEnum $type = RabbitmqHandlerEnum::JOB,
        array               $data = [],
        ?Carbon             $delay = null
    ): void
    {
        Queue::connection('rabbitmq')
            ->pushRaw(json_encode([
                $type->value => $action,
                "@type" => $type->value,
                "delay" => $delay,
                "uuid" => Str::uuid(),
                ...$data
            ], JSON_THROW_ON_ERROR), config('queue.connections.rabbitmq.queue'), [
                'exchange' => config('queue.connections.rabbitmq.options.exchange.name'),
                'exchange_type' => config('queue.connections.rabbitmq.exchange.type'),
            ]);
    }


}

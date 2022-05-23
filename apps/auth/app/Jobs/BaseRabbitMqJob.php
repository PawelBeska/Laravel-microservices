<?php

namespace App\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Jobs\RabbitMQJob as BaseJob;

class BaseRabbitMqJob extends BaseJob
{
    use Dispatchable, SerializesModels;

    /**
     * Fire the job.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \JsonException
     */
    public function fire()
    {
        $payload = $this->payload();
        ($this->instance = $this->resolve(Arr::get($payload, 'job')))->handle($payload);
        $this->delete();
    }

    /**
     * @throws \JsonException
     */
    public function payload(): array
    {
        return json_decode($this->getRawBody()??"{}", true, 512, JSON_THROW_ON_ERROR);

    }
}

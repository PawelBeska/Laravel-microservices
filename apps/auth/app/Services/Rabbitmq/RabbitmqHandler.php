<?php

namespace App\Services\Rabbitmq;

use App\Enum\RabbitmqHandlerEnum;
use App\Interfaces\RabbitmqHandlerInterface;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Jobs\RabbitMQJob as BaseJob;

class RabbitmqHandler extends BaseJob
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

        ($this->instance = $this->strategy())->handle($payload);
        $this->delete();
    }

    /**
     * @throws \JsonException
     */
    public function payload(): array
    {
        return json_decode($this->getRawBody() ?? "{}", true, 512, JSON_THROW_ON_ERROR);

    }

    public function strategy(): RabbitmqHandlerInterface
    {
        return match (Arr::get($this->payload(), '@type')) {
            RabbitmqHandlerEnum::JOB->value => RabbitmqHandlerEnum::JOB->getHandler(Arr::get($this->payload(), 'job')),
            RabbitmqHandlerEnum::EVENT->value => RabbitmqHandlerEnum::EVENT->getHandler(Arr::get($this->payload(), 'event')),
        };
    }
}

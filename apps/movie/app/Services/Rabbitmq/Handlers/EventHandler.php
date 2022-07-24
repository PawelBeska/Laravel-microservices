<?php

namespace App\Services\Rabbitmq\Handlers;

use App\Interfaces\RabbitEventInterface;
use App\Interfaces\RabbitJobInterface;
use App\Interfaces\RabbitmqHandlerInterface;

class EventHandler implements RabbitmqHandlerInterface {

    /**
     * @param \App\Interfaces\RabbitEventInterface|\App\Interfaces\RabbitJobInterface $action
     */
    public function __construct(private RabbitEventInterface|RabbitJobInterface $action)
    {

    }

    /**
     * @param ...$data
     * @return void
     */
    public function handle(...$data): void
    {

        $this->action->handle(...$data);
    }
}

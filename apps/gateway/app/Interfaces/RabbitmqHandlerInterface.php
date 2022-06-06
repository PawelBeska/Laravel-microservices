<?php

namespace App\Interfaces;

interface RabbitmqHandlerInterface
{
    public function __construct(RabbitEventInterface|RabbitJobInterface $action);
}

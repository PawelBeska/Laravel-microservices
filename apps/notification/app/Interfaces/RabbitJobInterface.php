<?php

namespace App\Interfaces;

interface RabbitJobInterface
{

    public function handle($data): void;
}

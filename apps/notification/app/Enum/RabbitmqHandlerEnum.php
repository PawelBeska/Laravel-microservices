<?php

namespace App\Enum;

use App\Services\Rabbitmq\Handlers\EventHandler;
use App\Services\Rabbitmq\Handlers\JobHandler;

enum RabbitmqHandlerEnum: string
{

    case JOB = "job";
    case EVENT = "event";

    public function getHandler($action)
    {
        return match ($this) {
            self::JOB => app()->make(JobHandler::class, ['action' => app()->make($action)]),
            self::EVENT => app()->make(EventHandler::class, ['action' => app()->make($action)])
        };
    }
}

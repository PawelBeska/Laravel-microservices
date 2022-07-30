<?php

namespace App\Enum;

use App\Services\Rabbitmq\Handlers\EventHandler;
use App\Services\Rabbitmq\Handlers\JobHandler;

enum MovieStatusEnum: string
{

    case ACTIVE = "active";
    case INACTIVE = "inactive";

    public function getTranslation($status)
    {
        return match ($this) {
            self::ACTIVE => __("Active"),
            self::INACTIVE => __("Inactive")
        };
    }
}

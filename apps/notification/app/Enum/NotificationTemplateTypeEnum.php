<?php

namespace App\Enum;

use App\Models\NotificationTemplate;
use App\Services\Notifications\Types\EmailNotificationType;
use App\Services\Rabbitmq\Handlers\EventHandler;
use App\Services\Rabbitmq\Handlers\JobHandler;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

enum NotificationTemplateTypeEnum: string
{

    case FIREBASE = "job";
    case SOCKET = "socket";
    case EMAIL = "email";

    public function getProvider(array $data, string|Collection|Model $notifiable, NotificationTemplate $notificationTemplate)
    {
        return match ($this) {
            self::FIREBASE => app()->make(),
            self::SOCKET => app()->make(),
            self::EMAIL => app()->make(EmailNotificationType::class, [$data, $notifiable, $notificationTemplate])
        };
    }
}

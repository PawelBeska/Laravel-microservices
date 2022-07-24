<?php

namespace App\Services\Notifications;

use App\Enum\NotificationTemplateTypeEnum;
use App\Models\Notification;
use App\Models\NotificationTemplate;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class NotificationFactory
{

    private ?array $files = null;

    private ?Carbon $delay = null;

    private bool $saveNotification = false;

    private ?Notification $notification = null;


    public function __construct(
        private array                   $data,
        private string|Collection|Model $notifiable,
        private ?string                 $from = null,
    )
    {

    }

    /**
     * @param array $files
     * @return $this
     */
    public function withFiles(array $files): static
    {
        $this->files = $files;
        return $this;
    }

    public function withSaveNotification(): static
    {
        $this->saveNotification = true;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function send(NotificationTemplate $notificationTemplate): void
    {
        if (!$notificationTemplate->type->value) {
            throw new \RuntimeException('Notification type ' . $notificationTemplate->type->value . ' does not exist');
        }

        $notification = $notificationTemplate->type->getProvider(
            $this->data,
            $this->notifiable,
            $notificationTemplate);

        if ($this->from && $notificationTemplate->type === NotificationTemplateTypeEnum::EMAIL) {
            $notification->withFrom($this->from);
        }

        if ($this->files) {
            $notification->withFiles($this->files);
        }


        if ($this->saveNotification) {
            (new NotificationService())->assignData(
                data: $this->data,
                notificationTemplate: $notificationTemplate,
                notifiable: $this->notifiable

            );
        }

        $notification->send();

    }
}

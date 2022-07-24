<?php

namespace App\Services\Notifications;

use App\Enum\NotificationTemplateTypeEnum;
use App\Enums\NotificationTemplateStatusEnum;
use App\Models\NotificationTemplate;

class NotificationTemplateService
{


    /**
     * @param \App\Models\NotificationTemplate $notificationTemplate
     */
    public function __construct(private NotificationTemplate $notificationTemplate = new NotificationTemplate())
    {

    }

    /**
     * @return \App\Models\NotificationTemplate
     */
    public function getNotificationTemplate(): NotificationTemplate
    {
        return $this->notificationTemplate;
    }

    /**
     * @param string $name
     * @param string $description
     * @param \App\Enum\NotificationTemplateTypeEnum $type
     * @param \App\Enums\NotificationTemplateStatusEnum $status
     * @param array $data
     * @return $this
     */
    public function assignData(
        string                         $name,
        string                         $description,
        NotificationTemplateTypeEnum   $type,
        NotificationTemplateStatusEnum $status,
        array                          $data = []
    ): static
    {
        $this->notificationTemplate->name = $name;
        $this->notificationTemplate->description = $description;
        $this->notificationTemplate->type = $type;
        $this->notificationTemplate->status = $status;
        $this->notificationTemplate->save();
        $this->notificationTemplate->data()->delete();
        $this->notificationTemplate->data()->createMany(
            $data
        );

        return $this;
    }

}

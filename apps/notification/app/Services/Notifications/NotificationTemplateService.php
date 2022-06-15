<?php

namespace App\Services\Notifications;

use App\Models\NotificationTemplate;

class NotificationTemplateService
{


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
     * @param array $data
     * @return $this
     */
    public function assignData(array $data): static
    {
        $this->notificationTemplate->name = $data['name'];
        $this->notificationTemplate->description = $data['description'];
        $this->notificationTemplate->type = $data['type'];
        $this->notificationTemplate->status = $data['status'];
        $this->notificationTemplate->save();
        return $this;
    }

}

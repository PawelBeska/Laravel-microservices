<?php

namespace App\Services\Notifications;

use App\Models\Notification;
use App\Models\NotificationTemplate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class NotificationService
{


    public function __construct(private Notification $notification = new Notification())
    {

    }

    /**
     * @param array $data
     * @param NotificationTemplate $notificationTemplate
     * @param \Illuminate\Database\Eloquent\Model|string $notifiable
     * @return Notification
     */
    public function assignData(array $data, NotificationTemplate $notificationTemplate, Model|string $notifiable): Notification
    {

        $this->notification->notification_template_id = $notificationTemplate->id;

        if ($notifiable instanceof Model) {
            $this->notification->notifiable()->associate($notifiable);
        } else {
            $this->notification->notifiable_type = $notifiable;
        }

        $this->notification->data = $data;
        $this->notification->save();

        return $this->notification;
    }

    /**
     * @param array $data
     * @param \App\Models\NotificationTemplate $notificationTemplate
     * @param \Illuminate\Database\Eloquent\Collection $notifiables
     * @return \Illuminate\Support\Collection
     */
    public static function assignManyData(array $data, NotificationTemplate $notificationTemplate, Collection $notifiables): \Illuminate\Support\Collection
    {
        $notifications = collect();
        foreach ($notifiables as $notifiable) {
            $notification = new Notification();
            $notification->notification_template_id = $notificationTemplate->id;
            $notification->notifiable = $notifiable;
            $notification->data = $data;
            $notification->save();
            $notifications->prepend($notification);
        }
        return $notifications;
    }

    /**
     * @param Notification|null $notification
     * @return Notification
     */
    public function read(Notification $notification = null): Notification
    {
        $notification = $notification ?: $this->notification;
        $notification->read_at = Carbon::now();
        $notification->save();
        return $notification;
    }
}

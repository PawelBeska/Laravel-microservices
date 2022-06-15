<?php

namespace App\Interfaces;

use App\Models\NotificationTemplate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface NotificationTypeInterface
{

    public function __construct(array $data, Collection|Model $notifiable,NotificationTemplate $notificationTemplate);

    public function send();
}

<?php

namespace App\Enums;

enum NotificationStatusEnum: string
{
    case SEND = 'send';
    case PENDING = 'pending';
    case VIEWED = 'viewed';

}

<?php

namespace App\Jobs;

use App\Interfaces\RabbitJobInterface;
use App\Models\ActionScript;
use App\Models\NotificationTemplate;
use App\Notifications\EmailNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Notification;

class SendRecievedNotificationJob implements ShouldQueue, RabbitJobInterface
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @param mixed $data
     * @return void
     */
    public function handle($data): void
    {
        EmailNotificationSendJob::dispatch(
            Arr::get($data, 'data', []),
            Arr::get($data, 'user.email', []),
            NotificationTemplate::query()->where('name', Arr::get($data, 'notification_template_name'))->firstOrFail(),
        );
    }
}

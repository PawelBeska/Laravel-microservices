<?php

namespace App\Jobs;

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
use Illuminate\Support\Facades\Notification;

class EmailNotificationSendJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public array                   $data,
        public string|Collection|Model $notifiable,
        public NotificationTemplate    $notificationTemplate,
        public ?array                  $files = null,
        private ?string                $from = null

    )
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {

        if ($this->notifiable instanceof Model) {
            $this->notifiable->notify(new EmailNotification(
                    data: $this->data,
                    notificationTemplate: $this->notificationTemplate,
                    files: $this->files,
                )
            );
        } else if ($this->notifiable instanceof Collection) {
            Notification::send($this->notifiable,
                new EmailNotification(
                    data: $this->data,
                    notificationTemplate: $this->notificationTemplate,
                    files: $this->files,
                )
            );
        } else {
            Notification::route('mail', $this->notifiable)
                ->notify(new EmailNotification(
                        data: $this->data,
                        notificationTemplate: $this->notificationTemplate,
                        files: $this->files,
                        from: $this->from,
                    )
                );
        }

    }
}

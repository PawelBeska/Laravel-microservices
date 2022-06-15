<?php


namespace App\Services\Notifications\Types;

use App\Interfaces\NotificationTypeInterface;
use App\Jobs\EmailNotificationSendJob;
use App\Models\ActionScript;
use App\Models\NotificationTemplate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class EmailNotificationType implements NotificationTypeInterface
{

    private array $data;

    private string|Collection|Model $notifiable;

    private ?string $from = null;

    private NotificationTemplate $notificationTemplate;

    private ?array $files = null;

    private ?Carbon $delay = null;

    /**
     * @param array $data
     * @param string|Collection|Model $notifiable
     * @param NotificationTemplate $notificationTemplate
     */
    public function __construct(array $data, string|Collection|Model $notifiable, NotificationTemplate $notificationTemplate)
    {
        $this->notifiable = $notifiable;
        $this->data = $data;
        $this->notificationTemplate = $notificationTemplate;
    }

    /**
     * @param string $from
     * @return $this
     */
    public function withFrom(string $from): static
    {
        $this->from = $from;
        return $this;
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

    /**
     * @param \Illuminate\Support\Carbon $delay
     * @return $this
     */
    public function withDelay(Carbon $delay): static
    {
        $this->delay = $delay;
        return $this;
    }

    public function send(): void
    {
        EmailNotificationSendJob::dispatch(
            data: $this->data,
            notifiable: $this->notifiable,
            notificationTemplate: $this->notificationTemplate,
            files: $this->files,
            from: $this->from
        )->delay($this->delay);
    }
}

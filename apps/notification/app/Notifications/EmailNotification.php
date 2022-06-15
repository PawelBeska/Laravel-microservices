<?php

namespace App\Notifications;

use App\Models\NotificationTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class EmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public array $data;

    public NotificationTemplate $notificationTemplate;

    public ?array $files;

    public ?string $from;


    public function __construct(
        array                $data,
        NotificationTemplate $notificationTemplate,
        array                $files = null,
        string               $from = null,
    )
    {
        $this->data = $data;
        $this->notificationTemplate = $notificationTemplate;
        $this->files = $files;
        $this->from = $from;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
            return ['mail'];
    }



    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     */
    public function toMail($notifiable)
    {

        $mail = (new MailMessage)
            ->greeting(null)
            ->salutation(new HtmlString(__('mail.salutation')))
            ->subject(
                Str::replace(
                    array_keys($this->data),
                    array_values($this->data),
                    optional($this->notificationTemplate->translationable()->firstWhere('type', '=', 'title'))->translation)
            )
            ->line(new HtmlString(
                    Str::replace(
                        array_keys($this->data),
                        array_values($this->data),
                        optional($this->notificationTemplate->translationable()->firstWhere('type', '=', 'content'))->translation))
            );
        if (Arr::get($this->data, 'button', false)) {
            $mail->action(new HtmlString(optional($this->notificationTemplate->translationable()->firstWhere('type', '=', 'buttonText'))->translation), Arr::get($this->data, 'button'));
        }

        if ($this->from) {
            $mail->replyTo($this->from);
        }


        if ($this->files) {
            foreach ($this->files as $key => $value) {
                $mail->attach($value, [
                    'as' => $key . substr($value, strpos($value, '.'))]);
            }
        }
        return $mail;

    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

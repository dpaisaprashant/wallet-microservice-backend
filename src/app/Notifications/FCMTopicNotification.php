<?php

namespace App\Notifications;

use App\Broadcasting\FCMChannel;
use App\Broadcasting\OneSignalChannel;
use App\Wallet\FCMTopicNotifier;
use App\Wallet\Notification\Repository\NotificationRepository;
use App\Wallet\OneSignalTagNotifier;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FCMTopicNotification extends Notification
{
    use Queueable;

    protected $topic;

    protected $title;

    protected $description;

    protected $type;

    protected string $channel;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($topic, $title, $description, $type)
    {
        $this->topic = $topic;
        $this->title = $title;
        $this->description = $description;
        $this->type = $type;

        $repository = new NotificationRepository(request());
        $this->channel = $repository->notificationChannel();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [/*'database',*/ $this->channel];
    }

    public function toDatabase($notifiable)
    {

        return [
            "title" => $this->title,
            "topic" => $this->topic,
            "description" => $this->description,
            "type" => $this->type
        ];
    }

    public function toOneSignal($notifiable)
    {
        $data = $this->toDatabase($notifiable);

        $data = array_merge([
            'id' => $this->id ?? null,
            'isRead' => false,
            "type" => $this->type,
            'readAt' => null,
            'createdAt' => now()->toDateTimeString()
        ], $data);
        (new OneSignalTagNotifier($data['title'], $data['description'], $data, $this->topic))
            ->send();
    }

    public function toFcm($notifiable)
    {
        $data = $this->toDatabase($notifiable);

        $data = array_merge([
            'id' => $this->id ?? null,
            'isRead' => false,
            "type" => $this->type,
            'readAt' => null,
            'createdAt' => now()->toDateTimeString()
        ], $data);
        (new FCMTopicNotifier($data['title'], $data, $data['description'], $this->topic))
            ->send();
    }
}

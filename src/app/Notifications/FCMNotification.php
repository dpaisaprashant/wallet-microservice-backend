<?php

namespace App\Notifications;

use App\Broadcasting\FCMChannel;
use App\Broadcasting\OneSignalChannel;
use App\Models\User;
use App\Wallet\FCMNotifier;
use App\Wallet\Notification\Repository\NotificationRepository;
use App\Wallet\OneSignalNotifier;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FCMNotification extends Notification
{
    use Queueable;

    protected $user;

    protected $title;

    protected $description;

    protected $type;

    protected $channel;


    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param $title
     * @param $description
     */
    public function __construct(User $user, $title, $description, $type)
    {
        $this->user = $user;
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
        return ['database', $this->channel];
    }

    public function toDatabase($notifiable)
    {
        $userInfo = $this->user->name . "(" . $this->user->mobile_no . ")";

        return [
            "title" => $this->title,
            "user" => $userInfo,
            "description" => $this->description,
            "type" => $this->type
        ];
    }

    public function toOneSignal($notifiable)
    {
        $data = $this->toDatabase($notifiable);

        $data = array_merge([
            'id' => $this->id,
            'isRead' => false,
            "type" => $this->type,
            'readAt' => null,
            'createdAt' => now()->toDateTimeString()
        ], $data);
        (new OneSignalNotifier($data['title'], $data['description'], $data, $this->user->mobile_no, $this->user->mobile_no))
            ->send();
    }

    public function toFcm($notifiable)
    {
        $data = $this->toDatabase($notifiable);

        $data = array_merge([
            'id' => $this->id,
            'isRead' => false,
            "type" => $this->type,
            'readAt' => null,
            'createdAt' => now()->toDateTimeString()
        ], $data);
        (new FCMNotifier($data['title'], $data['description'], $data, $this->user->fcm_token, $this->user->desktop_fcm))
            ->send();
    }
}

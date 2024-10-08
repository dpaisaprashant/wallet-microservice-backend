<?php

namespace App\Notifications;

use App\Broadcasting\FCMChannel;
use App\Models\UserReferralBonus;
use App\Models\UserReferralBonusTransaction;
use App\Wallet\FCMNotifier;
use App\Wallet\Notification\Repository\NotificationRepository;
use App\Wallet\OneSignalNotifier;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReferralUsedBonusNotification extends Notification
{
    use Queueable;

    public $referredFromUser;
    public $referredToUser;
    public $type;
    public $amount;
    protected string $channel;

    /**
     * Create a new notification instance.
     *
     * @param $referredToUser
     * @param $referredFromUser
     * @param $type
     */
    public function __construct($referredToUser, $referredFromUser, $type, $amount)
    {
        $this->referredFromUser = $referredFromUser;
        $this->referredToUser = $referredToUser;
        $this->type = $type;
        $this->amount = $amount / 100;

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

    public function toFcm($notifiable)
    {
        $data = $this->toDatabase($notifiable);

        $data = array_merge([
            'id' => $this->id,
            'type' => 'ReferralAccepted',
            'isRead' => false,
            'readAt' => null,
            'createdAt' => now()->toDateTimeString()
        ], $data);

        $notify = new FCMNotifier($data['title'], $data['description'], $data, $this->referredToUser->fcm_token, $this->referredToUser->desktop_fcm);
        $notify->send();
    }

    public function toOneSignal($notifiable)
    {
        $data = $this->toDatabase($notifiable);

        $data = array_merge([
            'id' => $this->id,
            'type' => 'ReferralAccepted',
            'isRead' => false,
            'readAt' => null,
            'createdAt' => now()->toDateTimeString()
        ], $data);

        $notify = new OneSignalNotifier($data['title'], $data['description'], $data, $this->referredToUser->mobile_no, $this->referredToUser->mobile_no);
        $notify->send();
    }

    public function toDatabase($notifiable)
    {
        //$userInfo = $this->referredFromUser->name . " ( " . $this->referredFromUser->mobile_no . " )";
        $userInfo = $this->referredFromUser->name;
        $description = $this->type == UserReferralBonusTransaction::TYPE_FIRST_TRANSACTION
            ? "You received referral bonus of Rs.{$this->amount} for first transaction"
            : "You received referral bonus of Rs.{$this->amount} for KYC Acceptance";

        return [
            "title" => "Referral Bonus",
            "user" => $userInfo,
            "description" => $description
        ];
    }




    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

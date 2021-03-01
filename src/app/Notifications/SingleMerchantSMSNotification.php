<?php

namespace App\Notifications;

use App\Broadcasting\SparrowChannel;
use App\Wallet\SparrowSMS\SendSMS;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SingleMerchantSMSNotification extends Notification
{
    use Queueable;

    public $description;
    public $merchant;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($description, $merchant)
    {
        $this->description = $description;
        $this->merchant = $merchant;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SparrowChannel::class];
    }

    public function toSparrow()
    {
        return (new SendSMS)->send($this->merchant->mobile_no, $this->description);
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
            'token' => $this->description->token
        ];
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OTPCodeGenerated extends Notification
{
    use Queueable;

    public $otp;
    public $admin;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($otp, $admin)
    {
        $this->otp = $otp;
        $this->admin = $admin;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Please use the code ' . $this->otp->token . ' to proceed with your action')
            ->line('Please go back to the application and enter the token ' . $this->otp->token)
            ->line('Thank you for using our application!');
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
            'token' => $this->otp->token,
            'admin' => $this->admin
        ];
    }
}

<?php

namespace App\Broadcasting;

use Illuminate\Notifications\Notification;

class SparrowChannel
{

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSparrow($notifiable);

        // Send notification to the $notifiable instance...
    }
}

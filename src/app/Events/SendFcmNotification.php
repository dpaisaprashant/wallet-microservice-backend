<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendFcmNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $title;

    public $message;

    public $data;

    public $notification_type;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $title, $message, $data, $notification_type)
    {
        $this->user = $user;
        $this->title = $title;
        $this->message = $message;
        $this->data = $data;
        $this->notification_type = $notification_type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

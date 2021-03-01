<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendFcmTopicNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $topics = [];

    public $title;

    public $message;

    public $data;

    public $notification_type;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($topics, $title, $message, $data, $notification_type)
    {
        $this->topics = $topics;
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

<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LoadTestFundEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $transaction;

    public $vendor;

    public $serviceType;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($transaction, $vendor = null, $serviceType = null)
    {
        $this->transaction = $transaction;
        $this->vendor = $vendor;
        $this->serviceType = $serviceType;
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

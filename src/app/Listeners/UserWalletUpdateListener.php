<?php

namespace App\Listeners;

use App\Models\Wallet;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Exception;

class UserWalletUpdateListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        try {
            (new Wallet())->addBalance($event->userId, $event->amount);
        } catch (Exception $e) {
            Log::debug("User wallet couldn't be updated on UserWalletUpdateListener");
            Log::debug($e->getMessage());
        }
    }
}

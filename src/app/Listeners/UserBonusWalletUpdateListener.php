<?php

namespace App\Listeners;

use App\Models\Wallet;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class UserBonusWalletUpdateListener
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
        Log::debug('=========18. UserBonusWalletUpdateEvent Fired ==========');
        //try {
        (new Wallet)->addBonusBalance($event->userId, $event->amount);
        Log::debug('=========18. Bonus Wallet Added ==========');
        //} catch (Exception $e) {
        //    Log::debug("Error on UserWalletPaymentListener while deducting the balance");
        //    Log::debug($e, ["context" => $request]);
        //}
    }
}

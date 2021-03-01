<?php

namespace App\Listeners;

use App\Models\Wallet;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Exception;

class UserWalletPaymentListener
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
        try{
            (new Wallet)->subtractBalance($event->userId, $event->amount);
        } catch (Exception $e){
            dd($e);
            Log::debug("Error on UserWalletPaymentListener while deducting the balance");
            Log::debug($e->getMessage());
        }
    }
}

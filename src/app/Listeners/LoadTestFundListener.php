<?php

namespace App\Listeners;

use App\Events\UserWalletUpdateEvent;
use App\Models\Wallet;
use App\Wallet\Helpers\TransactionIdGenerator;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoadTestFundListener
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $currentBalance = Wallet::whereUserId($event->transaction->user_id)->first()->balance * 100;
        $amount = $event->transaction->amount * 100;
        $event->transaction->transactions()->create([
            "account" => $event->transaction->user->mobile_no,
            "amount" => $amount,
            "vendor" => 'TEST FUND',
            "user_id" => $event->transaction->user_id,
            "description" => $event->transaction->description,
            "service_type" => "LOAD_TEST_FUND",
            "balance" => $currentBalance + $amount,
            "uid" => 'LOAD-TEST-FUND-' . TransactionIdGenerator::generateAlphaNumeric(7)
        ]);

        event(new UserWalletUpdateEvent($event->transaction->user_id, $event->transaction->amount * 100));
    }
}

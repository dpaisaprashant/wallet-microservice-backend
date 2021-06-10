<?php

namespace App\Listeners;

use App\Events\UserBonusWalletUpdateEvent;
use App\Events\UserWalletUpdateEvent;
use App\Models\Wallet;
use App\Wallet\Helpers\TransactionIdGenerator;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

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
        $currentBonusBalance = Wallet::whereUserId($event->transaction->user_id)->first()->bonus_balance * 100;
        $amount = $event->transaction->amount * 100;
        $bonusAmount = $event->transaction->bonus_amount * 100;
        $event->transaction->transactions()->create([
            "account" => $event->transaction->user->mobile_no,
            "amount" => $amount + $bonusAmount,
            "vendor" => $event->transaction->pre_transaction_id ? "REFUND" : "TEST FUND",
            "user_id" => $event->transaction->user_id,
            "description" => $event->transaction->description,
            "service_type" => $event->transaction->pre_transaction_id ? "REFUND" : "LOAD_TEST_FUND",
            "balance" => $currentBalance + $amount + $bonusAmount,
            "bonus_balance" => $currentBonusBalance,
            "uid" => $event->transaction->pre_transaction_id
                ? "REFUND-" . TransactionIdGenerator::generateAlphaNumeric(7)
                : 'LOAD-TEST-FUND-' . TransactionIdGenerator::generateAlphaNumeric(7)
        ]);


        Log::info("=============================REFUND======================================");
        Log::info("user id: " . $event->transaction->user_id);
        Log::info("main balance refund: " . $amount);
        Log::info("bonus balance refund: " . $bonusAmount);
        Log::info("=========================================================================");


        if ($amount > 0) {
            event(new UserWalletUpdateEvent($event->transaction->user_id, $amount));
        }

        if ($bonusAmount) {
            event(new UserBonusWalletUpdateEvent($event->transaction->user_id, $bonusAmount));
        }

    }
}

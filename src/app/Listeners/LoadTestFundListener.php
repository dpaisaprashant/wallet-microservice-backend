<?php

namespace App\Listeners;

use App\Events\UserBonusWalletUpdateEvent;
use App\Events\UserWalletUpdateEvent;
use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;
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
        $preTransactionId = $event->transaction->pre_transaction_id ?? null;

        $vendor = $event->vendor
            ?: ($preTransactionId ? "REFUND" : "TEST FUND");

        $serviceType = $event->serviceType
            ?: ($preTransactionId ? "REFUND" : "LOAD_TEST_FUND");

        $uid  = $event->serviceType
            ?: ($preTransactionId ? "REFUND" : "LOAD-TEST-FUND");

        $currentBalance = Wallet::whereUserId($event->transaction->user_id)->first()->balance * 100;
        $currentBonusBalance = Wallet::whereUserId($event->transaction->user_id)->first()->bonus_balance * 100;
        $amount = $event->transaction->amount * 100;
        $bonusAmount = $event->transaction->bonus_amount * 100;
        $loadTransactionEvent = $event->transaction->transactions()->create([
            "account" => $event->transaction->user->mobile_no,
            "amount" => $amount + $bonusAmount,
            "vendor" => $vendor,
            "user_id" => $event->transaction->user_id,
            "description" => $event->transaction->description,
            "service_type" => $serviceType,
            "balance" => $currentBalance + $amount ,
            "bonus_balance" => $currentBonusBalance + $bonusAmount,
            "uid" => $event->transaction->pre_transaction_id
                ? $uid . "-" . TransactionIdGenerator::generateAlphaNumeric(7)
                : $uid . '-' . TransactionIdGenerator::generateAlphaNumeric(7),
            "account_type" => "credit",
            "refund_pre_transaction_id" => $preTransactionId
        ]);

        if ($preTransactionId) {
            TransactionEvent::where("pre_transaction_id", $preTransactionId)
                ->whereNotNull("pre_transaction_id")
                ->where("service_type", "!=", "REFUND")
                ->update(["refund_id" => $event->transaction->id]);

            PreTransaction::where('pre_transaction_id', $preTransactionId)
                ->update(["refund_id" =>  $event->transaction->id]);
        }


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

<?php

namespace App\Wallet\SystemRepost\Repost\Strategies\NpsAccountLink;

use App\Models\Microservice\PreTransaction;
use App\Models\NPSAccountLinkLoad;
use App\Models\TransactionEvent;
use App\Wallet\Helpers\TransactionIdGenerator;
use App\Wallet\SystemRepost\Repost\Contracts\SystemRepostContract;
use Illuminate\Support\Facades\Log;

class NpsAccountLinkSystemRepostStrategy implements SystemRepostContract
{

    public function performRepost(PreTransaction $preTransaction)
    {

        $npsLoadTransaction = NPSAccountLinkLoad::with('linkedAccount')
            ->where("reference_id", $preTransaction->pre_transaction_id)
            ->first();


        Log::info("6. perform repost of nps load");

        $updateBalance = request()->update_balance ? 1 : 0;
        $updateTimeStamp = request()->update_timestamp ? 1 :0;


            Log::info("CREATE TRANSACTION EVENTS");


            if ($updateBalance == 1){
                if ($preTransaction->transaction_type == "credit"){
                    $transaction_event_balance = $preTransaction->amount + $preTransaction->user->wallet->balance;
                }elseif($preTransaction->transaction_type == "debit"){
                    $transaction_event_balance = $preTransaction->user->wallet->balance - $preTransaction->amount;
                }
            }elseif($updateBalance == 0){
                $transaction_event_balance = $preTransaction->user->wallet->balance;
            }

            $create_transaction_event = [
                'pre_transaction_id' => $preTransaction->pre_transaction_id,
                'amount' => $preTransaction->amount,
                'account' => $npsLoadTransaction->linkedAccount->account_number,
                'description' => "Nps Account Link Load system repost",
                'vendor' => $npsLoadTransaction->linkedAccount->bank_code,
                'service_type' => 'LOAD',
                'user_id'  => $preTransaction->user_id,
                'transaction_id'  => $npsLoadTransaction->id,
                'transaction_type'  => request()->transaction_type,
                'uid'  => TransactionIdGenerator::generateAlphaNumeric(7),
                'balance'  => $transaction_event_balance,
                'bonus_balance'  => $preTransaction->user->wallet->bonus_balance,
                'account_type'  => $preTransaction->transaction_type,
            ];

            $transactionEvent = TransactionEvent::create($create_transaction_event);

        // TODO: Implement performRepost() method.
    }
}

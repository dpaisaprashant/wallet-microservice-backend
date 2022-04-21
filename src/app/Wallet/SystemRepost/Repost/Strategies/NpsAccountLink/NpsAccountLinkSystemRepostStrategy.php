<?php

namespace App\Wallet\SystemRepost\Repost\Strategies\NpsAccountLink;

use App\Events\UserWalletUpdateEvent;
use App\Models\Microservice\PreTransaction;
use App\Models\NPSAccountLinkLoad;
use App\Models\TransactionEvent;
use App\Wallet\Helpers\TransactionIdGenerator;
use App\Wallet\SystemRepost\Repost\Contracts\SystemRepostContract;
use Illuminate\Support\Facades\Log;

class NpsAccountLinkSystemRepostStrategy implements SystemRepostContract
{

    public function performRepost(PreTransaction $preTransaction) : TransactionEvent
    {

        //1. microservice database update
        //2. create transaction event

        $npsLoadTransaction = NPSAccountLinkLoad::with('linkedAccount')
            ->where("reference_id", $preTransaction->pre_transaction_id)
            ->first();

        $npsLoadTransaction->update(['load_status' => NPSAccountLinkLoad::LOAD_STATUS_SUCCESS]);

        Log::info("6. perform repost of nps load");


        Log::info("CREATE TRANSACTION EVENTS");

        $create_transaction_event = [
            'pre_transaction_id' => $preTransaction->pre_transaction_id,
            'amount' => $preTransaction->amount * 100,
            'account' => $npsLoadTransaction->linkedAccount->account_number,
            'description' => "Nps Account Link Load system repost",
            'vendor' => $npsLoadTransaction->linkedAccount->bank_code,
            'service_type' => 'LOAD',
            'user_id' => $preTransaction->user_id,
            'transaction_id' => $npsLoadTransaction->id,
            'transaction_type' => request()->transaction_type,
            'uid' => TransactionIdGenerator::generateAlphaNumeric(7),
            'account_type' => $preTransaction->transaction_type,
        ];

        $transactionEvent = TransactionEvent::create($create_transaction_event);

        return $transactionEvent;

        // TODO: Implement performRepost() method.
    }
}

<?php

namespace App\Traits;

use App\Models\Microservice\PreTransaction;
use App\Models\Wallet;
use App\Wallet\Helpers\TransactionIdGenerator;

trait CreateSelfPreTransactionForLoadTestFund{

    public function createPreTransaction($request,$service_type, $description,$currentBalance,$currentBonusBalance = null,$preTransaction = null ,$total = null, $user = null){
//        $currentBalance = Wallet::whereUserId($user->id ?? $request->user_id)->first()->balance * 100;
//        $currentBonusBalance = Wallet::whereUserId($user->id ?? $request->user_id)->first()->bonus_balance * 100;
        $for_pre_transaction = [
            'pre_transaction_id' => TransactionIdGenerator::generate(20),
            'user_id' => $user->id ?? $request->user_id,
            'amount' => $total * 100 ?? $request['amount'] *100,
            'description' => $description,
            'vendor' => 'WALLET',
            'service_type' => $service_type,
            'microservice_type' => 'WALLET',
            'transaction_type' => PreTransaction::TRANSACTION_TYPE_CREDIT,
            'url' => '/refund',
            'status' => PreTransaction::STATUS_STARTED,
            'before_balance' => $currentBalance,
            'after_balance' => $currentBalance + ($request['amount'] * 100),
            'before_bonus_balance' => $currentBonusBalance,
            'after_bonus_balance' => $currentBonusBalance + ($request['bonus_amount'] * 100),
            'special1' => $preTransaction->pre_transaction_id ?? null,
        ];
        return $for_pre_transaction;
    }
}

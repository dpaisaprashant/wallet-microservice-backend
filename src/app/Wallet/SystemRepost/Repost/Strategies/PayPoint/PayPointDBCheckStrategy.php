<?php

namespace App\Wallet\SystemRepost\Repost\Strategies\PayPoint;

use App\Models\Microservice\PreTransaction;
use App\Models\NPSAccountLinkLoad;
use App\Models\TransactionEvent;
use App\Models\UserExecutePayment;
use App\Models\UserTransaction;
use App\Wallet\SystemRepost\Repost\Contracts\CheckByDatabaseContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PayPointDBCheckStrategy implements CheckByDatabaseContract
{

    public function checkMicroserviceDatabaseStatus(PreTransaction $preTransaction)
    {
        $payPointUserTransaction = UserTransaction::where("pre_transaction_id", $preTransaction->pre_transaction_id)
            ->first();

        if ($payPointUserTransaction) return [
            'before_transaction_status' => 'SUCCESS',
            'error_description' => "The Transaction is Success in the Microservice",
            'status' => "ERROR"
        ];

        $payPointExecutePayment = UserExecutePayment::where("pre_transaction_id", $preTransaction->pre_transaction_id)
            ->first();

        if ($payPointExecutePayment && ($payPointExecutePayment->code != "000" && $payPointExecutePayment->code != "111" && $payPointExecutePayment->code != "099")) {
            return [
                'before_transaction_status' => 'FAILED',
                'error_description' => "The Transaction Failed in the Microservice",
                'status' => "PROCESSING"
            ];
        } else {
            return [
                'before_transaction_status' => NULL,
                'error_description' => "The Transaction doesn't exist in the Microservice",
                'status' => "ERROR"
            ];
        }





    }
}

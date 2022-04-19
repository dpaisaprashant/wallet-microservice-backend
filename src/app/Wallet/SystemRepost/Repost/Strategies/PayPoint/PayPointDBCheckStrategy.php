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

        if ($payPointUserTransaction) dd('user_transaction exists');

        $payPointExecutePayment = UserExecutePayment::where("pre_transaction_id", $preTransaction->pre_transaction_id)
            ->first();

        if ($payPointExecutePayment && ($payPointExecutePayment->code == "000" || $payPointExecutePayment->code == "111" || $payPointExecutePayment->code == "099")) {
            return $preTransaction;
        } else {
            return ['status' => "Payment was not executed successfully."];
        }
    }
}

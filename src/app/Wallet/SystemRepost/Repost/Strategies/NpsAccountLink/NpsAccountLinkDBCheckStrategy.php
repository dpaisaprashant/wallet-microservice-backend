<?php

namespace App\Wallet\SystemRepost\Repost\Strategies\NpsAccountLink;

use App\Models\Microservice\PreTransaction;
use App\Models\NPSAccountLinkLoad;
use App\Models\TransactionEvent;
use App\Wallet\SystemRepost\Repost\Contracts\CheckByDatabaseContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NpsAccountLinkDBCheckStrategy implements CheckByDatabaseContract
{

    public function checkMicroserviceDatabaseStatus(PreTransaction $preTransaction)
    {
        /**
         *
         * @returns [
         *          "before_transaction_status" => "failed" / null,
         *          "error_description" => "reason for error",
         *          "status" => "ERROR" / "PROCESSING"
         *       ]
         */
        $microServiceStatus = NPSAccountLinkLoad::where('reference_id','=',$preTransaction->pre_transaction_id)->first('load_status');
        if ($microServiceStatus){
            if ($microServiceStatus['load_status'] == "Transaction Success"){
                return [
                    'before_transaction_status' => $microServiceStatus['load_status'],
                    'error_description' => "The Transaction is Success in the Microservice",
                    'status' => "ERROR"
                ];
            }else{
                return [
                    'before_transaction_status' => $microServiceStatus['load_status'],
                    'error_description' => "",
                    'status' => "PROCESSING"
                ];
            }
        }else{
            return [
                'before_transaction_status' => null,
                'error_description' => "Transaction Does not Exist in the Microservice for the Given Pre-Transaction",
                'status' => "ERROR"
            ];
        }
        // TODO: Implement checkMicroserviceDatabaseStatus() method.
    }
}

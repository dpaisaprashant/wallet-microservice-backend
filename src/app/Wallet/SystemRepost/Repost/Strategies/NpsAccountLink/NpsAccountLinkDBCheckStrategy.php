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
        $microServiceStatus = NPSAccountLinkLoad::where('reference_id', '=', $preTransaction->pre_transaction_id)->first();
        if ($microServiceStatus) {
            $gateway_id = request()->transaction_id_1 ?: 0;
            if (! $gateway_id) {
                return [
                    'before_transaction_status' => $microServiceStatus['load_status'],
                    'error_description' => "gateway transaction id not present in the request, enter gateway transaction id in Microservice Transaction ID 1 input field",
                    'status' => "ERROR"
                ];
            }

            if ($microServiceStatus['load_status'] == "Transaction Success") {
                return [
                    'before_transaction_status' => $microServiceStatus['load_status'],
                    'error_description' => "The Transaction is Success in the Microservice",
                    'status' => "ERROR"
                ];
            } else {
                return [
                    'before_transaction_status' => $microServiceStatus['load_status'],
                    'error_description' => "",
                    'status' => "PROCESSING"
                ];
            }
        } else {
            return [
                'before_transaction_status' => null,
                'error_description' => "Transaction Does not Exist in the Microservice for the Given Pre-Transaction",
                'status' => "ERROR"
            ];
        }

        //TODO: update pre_transaction status
        // TODO: Implement checkMicroserviceDatabaseStatus() method.
    }
}

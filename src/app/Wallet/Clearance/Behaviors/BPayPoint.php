<?php

namespace App\Wallet\Clearance\Behaviors;

use App\Models\ClearanceTransaction;
use App\Models\PaypointToDpaisaTransaction;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use App\Wallet\Clearance\Clearance;
use App\Wallet\Clearance\Interfaces\IClearance;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BPayPoint implements IClearance
{

    private  $count = 0;

    private function getDisputedTransactions($clearanceId){
        // User_load_transaction table => gateway_ref_no, transaction_id, amount, service_charge, net_amount, cbs_status
        // VS [clearanceId]
        // nPay_to_dpaisa_clearance_transactions table => gateway_ref_no, transaction_id, amount, service_charge, net_amount, cbs_status
        // return disputedTransactions
        $clearanceIds = ClearanceTransaction::where('clearance_id', $clearanceId)
            ->where('transaction_type', UserTransaction::class)
            ->pluck('transaction_id');

       /*$userTransactions = UserTransaction::with('clearanceTransactions')
           ->whereHas('microservice_core.clearanceTransactions', function ($query) use ($clearanceId) {
               return $query->where('clearance_id', $clearanceId);
           })->get();*/

       $userTransactions = UserTransaction::with('clearanceTransactions')
           ->whereIn('id', $clearanceIds)
           ->get();

       $uploadedTransactions = PaypointToDpaisaTransaction::where('clearance_id', $clearanceId)->get();


        $disputedTransactions  =  $userTransactions->map(function ($value, $key) use ($uploadedTransactions){
            foreach ($uploadedTransactions as $transaction) {
                if ($value->refStan == $transaction->refStan) {
                    $this->count++;
                    if ($value->amount != (double) str_replace(',','',$transaction->amount)) {
                        $value['vendor_amount'] = $transaction['amount'];
                        if ($transaction->status == 'OK ( 1 )') {
                            $value['vendor_status'] = 'SUCCESS';
                        }
                        return $value;
                    }

                }
            }
       })->filter();

        if ($this->count == 0) {
            return $userTransactions;
        }

       return $disputedTransactions;


       /* $correctTransactions = $userTransactions->filter(function ($value, $key) use ($uploadedTransactions){
            foreach ($uploadedTransactions as $transaction) {
                if ($value->refStan === $transaction->refStan && $value->amount == (double) str_replace(',','',$transaction->amount)) {
                    return $value;
                }
            }
        });*/

    }


    public function checkDateOfUploadedFile($thirdPartyTransactionList, $date)
    {
        try {
            $uploadedDate = [];
            foreach ($thirdPartyTransactionList as $key => $transactions){
                $uploadedDate[$key] = Carbon::parse($transactions['registration_date'])->format('Y-m-d');
            }

            $dateCollection = collect($uploadedDate);
            $uploadedFrom =  $dateCollection->min();
            $uploadedTo =  $dateCollection->max();

            if ($uploadedFrom == $date['from'] && $uploadedTo == $date['to']) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function uploadTransaction($third_party_transaction_list, $clearanceId)
    {
       foreach ($third_party_transaction_list as $key => $data) {
           $third_party_transaction_list[$key]['clearance_id'] = $clearanceId;
       }

       PaypointToDpaisaTransaction::insert($third_party_transaction_list);
    }

    public function isClearanceCorrect($clearanceId)
    {
        if(count($this->getDisputedTransactions($clearanceId))){
            return false;
        }
        else {

            $clearance = \App\Models\Clearance::with('clearanceTransactions', 'admin')->where('id', $clearanceId)->firstOrFail();
            $clearance->clearance_status = \App\Models\Clearance::STATUS_CLEARED;
            $clearance->save();

            return true;
        }
    }

    public function getDisputedTransactionList($clearanceId)
    {
        return $this->getDisputedTransactions($clearanceId);

    }

    public function getCorrectTransactionList($clearanceId)
    {
        // user_transactions table => refStan, transaction_id, amount, commission, status
        // VS [clearanceId]
        // payPoint_to_dpaisa_clearance_transactions table => refStan, transaction_id, amount, commission, status
        // return correctTransactionList
    }


}

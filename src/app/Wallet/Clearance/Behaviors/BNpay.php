<?php

namespace App\Wallet\Clearance\Behaviors;

use App\Models\NpayToDpaisaClearanceTransaction;
use App\Models\UserLoadTransaction;
use App\Wallet\Clearance\Interfaces\IClearance;
use Carbon\Carbon;

class BNpay implements IClearance
{

    private $count = 0;

    private function getDisputedTransactions($clearanceId){
        // User_load_transaction table => gateway_ref_no, transaction_id, amount, service_charge, net_amount, cbs_status
        // VS [clearanceId]
        // nPay_to_dpaisa_clearance_transactions table => gateway_ref_no, transaction_id, amount, service_charge, net_amount, cbs_status
        // return disputedTransactions

        $userLoadTransaction = UserLoadTransaction::with('clearanceTransactions')
            ->whereHas('clearanceTransactions', function ($query) use ($clearanceId) {
                return $query->where('clearance_id', $clearanceId);
            })->get();

        $uploadedTransactions = NpayToDpaisaClearanceTransaction::where('clearance_id', $clearanceId)->get();


        $disputedTransaction =   $userLoadTransaction->map(function ($value, $key) use ($uploadedTransactions){
            foreach ($uploadedTransactions as $transaction) {
                if ($value->transaction_id === trim($transaction->customer_transaction_id)) {

                    $this->count = $this->count + 1;
                    $value['vendor_amount'] = (double) trim($transaction->amount) * 100;
                    $value['vendor_status'] =  trim($transaction->cbs_status);

                    if ((double)($value->amount) != (double) trim(str_replace(',','',$transaction->amount))) {
                        return $value;
                    }

                    if ($value->status == 'COMPLETED') {
                        if(trim($transaction->cbs_status) != 'SUCCESS') {
                            return $value;
                        }
                    }

                    if ($value->status == 'ERROR') {
                        if (trim($transaction->cbs_status) != 'ERROR') {
                            return $value;
                        }
                    }

                    if ($value->status == 'VALIDATED') {
                        if (trim($transaction->cbs_status) != 'ERROR') {
                            return $value;
                        }
                    }

                   /* if ($value->gateway_ref_no != trim($transaction->gateway_ref_no)) {
                        return $value;
                    }*/
                }

            }
        })->filter();

        if ( $this->count === 0) {
            return $userLoadTransaction;
        }

        return $disputedTransaction;

    }

    public function checkDateOfUploadedFile($thirdPartyTransactionList, $date)
    {
        try {
            $uploadedDate = [];
            foreach ($thirdPartyTransactionList as $key => $transactions){
                $uploadedDate[$key] = Carbon::parse($transactions['transaction_date'])->format('Y-m-d');
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
        foreach ($third_party_transaction_list as $data) {
            $data['clearance_id'] = $clearanceId;
            $data['cbs_status'] == "" ? $data['cbs_status'] = 'ERROR' : $data['cbs_status'] ;
            NpayToDpaisaClearanceTransaction::create($data);
        }
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

    }


}

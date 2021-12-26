<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NeaSettlement extends Model
{
//    public function bankTransfer(){
//        $this->belongsTo(NonRealTimeBankTransfer::class);
//    }
protected $guarded = [];



    public function successfulBankTransfer($settleNea)
    {
        if (($settleNea['cipsTxnResponseList'][0]['creditStatus'] == '000' || $settleNea['cipsTxnResponseList'][0]['creditStatus'] == '999' || $settleNea['cipsTxnResponseList'][0]['creditStatus'] == 'DEFER')&&
            ($settleNea['cipsBatchResponse']['debitStatus'] == '000')) {
            return true;
        }
        return false;
    }

    public function pendingBankTransfer($settleNea)
    {
        if ($settleNea['cipsBatchResponse']['debitStatus'] == 'ENTR' || $settleNea['cipsTxnResponseList'][0]['creditStatus'] == 'ENTR') {
            return true;
        }
        return false;
    }

}

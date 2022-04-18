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
//        dd($preTransaction);
        $microServiceStatus = NPSAccountLinkLoad::where('reference_id','=',$preTransaction->pre_transaction_id)->first('load_status','id');
//        dd($microServiceStatus);
        if ($microServiceStatus){
            return $microServiceStatus;
        }else{
            return ['load_status'=>"no records found"];
        }
        // TODO: Implement checkMicroserviceDatabaseStatus() method.
    }
}

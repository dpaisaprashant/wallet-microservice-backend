<?php

namespace Database\Seeders;

use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddPreTransactionCreatedAt extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $preTransactionCreatedAts=DB::connection('dpaisa')->select('SELECT created_at,pre_transaction_id FROM pre_transactions');

        foreach($preTransactionCreatedAts as $each)
        {
            TransactionEvent::where('pre_transaction_id',$each->pre_transaction_id)->update(['pre_transaction_created_at'=> $each->created_at]);
        }

        $transactionEventsCreatedAts=DB::select('SELECT created_at,pre_transaction_id,pre_transaction_created_at FROM transaction_events');
        foreach($transactionEventsCreatedAts as $each){
            if($each->pre_transaction_created_at == NULL){
                TransactionEvent::where('pre_transaction_created_at',null)->update(['pre_transaction_created_at'=>$each->created_at]);
            }
        }
    }
}

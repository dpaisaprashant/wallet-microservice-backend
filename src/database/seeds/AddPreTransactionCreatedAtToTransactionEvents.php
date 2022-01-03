<?php

use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddPreTransactionCreatedAtToTransactionEvents extends Seeder
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
            TransactionEvent::where('pre_transaction_id',$each->pre_transaction_id)->update('pre_transaction_created_at',$each->created_at);
        }

//        $transactionEventsCreatedAt=DB::connection('dpaisa')->select('SELECT created_at,pre_transaction_id FROM transaction_events');
//        TransactionEvent::where('pre_transaction_created',null)->where('pre_transaction_id',$transactionEventsCreatedAt->)->update('pre_transaction_created_at',$transactionEventsCreatedAt->created_at);
    }
}

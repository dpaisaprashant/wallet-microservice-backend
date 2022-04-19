<?php

namespace App\Wallet\SystemRepost\Repost\Strategies\PayPoint;

use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;
use App\Models\UserExecutePayment;
use App\Models\UserTransaction;
use App\Wallet\Helpers\TransactionIdGenerator;
use App\Wallet\SystemRepost\Repost\Contracts\SystemRepostContract;
use App\Wallet\SystemRepost\Traits\ResolvePPTransactionEventsServiceTypeVendor;
use App\Wallet\SystemRepost\Traits\ResolvePPVendor;
use Illuminate\Support\Facades\Log;

class PayPointSystemRepostStrategy implements SystemRepostContract
{
    use ResolvePPVendor, ResolvePPTransactionEventsServiceTypeVendor;

    public function performRepost(PreTransaction $preTransaction) : TransactionEvent
    {
        Log::info("6. perform repost of PAYPOINT");

        //************************ CREATING PAYPOINT MICROSERVICE user_transactions ROW ****************************************//

        $payPointExecutePayment = UserExecutePayment::where("pre_transaction_id", $preTransaction->pre_transaction_id)
            ->first();

        $requestJson = json_decode($payPointExecutePayment->request);
        $account = $requestJson->account;
        $vendor = $this->resolveVendor($requestJson->companyCode, $requestJson->serviceCode, $requestJson->serviceType);

        UserTransaction::create([
            'pre_transaction_id' => $payPointExecutePayment->pre_transaction_id,
            'request_id' => $payPointExecutePayment->request_id,
            'amount' => $preTransaction->amount * 100,
            'vendor' => $vendor,
            'refStan' => $payPointExecutePayment->refStan_request,
            'account' => $account,
            'before_amount' => 0,
            'after_amount' => 0,
        ]);

        UserExecutePayment::where('pre_transaction_id',$payPointExecutePayment->pre_transaction_id)->update([
            'code' => '000',
        ]);

        //*********************************************************************************************************//

        //************************ CREATING transaction_events ROW in CORE ****************************************//

        Log::info("CREATE TRANSACTION EVENTS");

        $payPointUserTransaction = UserTransaction::where("pre_transaction_id", $preTransaction->pre_transaction_id)
            ->first();

        $resolvedData = $this->resolveVendorServiceType($payPointUserTransaction);
        $transactionEventVendor = $resolvedData['vendor'];
        $transactionEventServiceType = $resolvedData['serviceType'];

        $create_transaction_event = [
            'pre_transaction_id' => $preTransaction->pre_transaction_id,
            'amount' => $preTransaction->amount*100,
            'account' => $account,
            'description' => "PayPoint System Repost",
            'vendor' => $transactionEventVendor,
            'service_type' => $transactionEventServiceType,
            'user_id' => $preTransaction->user_id,
            'transaction_id' => $payPointUserTransaction->id,
            'transaction_type' => request()->transaction_type,
            'uid' => TransactionIdGenerator::generateAlphaNumeric(7),
            'balance' => 0,
            'bonus_balance' => 0,
            'account_type' => $preTransaction->transaction_type,
        ];

        return TransactionEvent::create($create_transaction_event);
    }
}

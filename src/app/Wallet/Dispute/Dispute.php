<?php


namespace App\Wallet\Dispute;


use App\Models\Clearance;
use App\Models\ClearanceTransaction;
use App\Models\DisputeTransaction;
use App\Models\NchlBankTransfer;
use App\Models\NchlLoadTransaction;
use App\Wallet\Dispute\Interfaces\IDispute;
use Illuminate\Foundation\Auth\User;

class Dispute
{
    private $IDisputeBehaviour;

    public function __construct(IDispute $IDisputeBehaviour)
    {
        $this->IDisputeBehaviour = $IDisputeBehaviour;
    }

    public function createDispute($disputedTransactionList, $clearanceId, $disputeType)
    {
        //Change disputed status in clearance and clearance_transactions table to (1)
        Clearance::whereId($clearanceId)->update(['dispute_status' => 1]);

        foreach ($disputedTransactionList as $key => $transaction) {
            ClearanceTransaction::where('clearance_id', $clearanceId)
                ->where('transaction_id', $transaction['id'])
                ->update(['dispute_status' => 1]);
        }

        //Create dispute with disputed_clearance_id as FK
        if ($disputeType == 'nPay') {
            $transactionType  = 'App\Models\UserLoadTransaction';
        } elseif($disputeType == 'payPoint') {
            $transactionType = 'App\Models\UserTransaction';
        } elseif ($disputeType == 'nchlBankTransfer') {
            $transactionType = NchlBankTransfer::class;
        } elseif ($disputeType == 'nchlLoadTransaction') {
            $transactionType = NchlLoadTransaction::class;
        }

        $dispute = \App\Models\Dispute::create([
            'disputed_clearance_id' => $clearanceId,
            'status' => 'DISPUTE',
            'dispute_transaction_count' => count($disputedTransactionList),
            'dispute_amount' => 0,
            'dispute_type' => $disputeType
        ]);

        //insert to dispute_transaction polymorphic pivot table
        $pivot = [];
        foreach ($disputedTransactionList as $key => $transaction) {
            $pivot[$key]['dispute_id'] = $dispute->id;
            $pivot[$key]['transaction_id'] = $transaction->id;
            $pivot[$key]['transaction_type'] = $transactionType;
            $pivot[$key]['dispute_status'] = DisputeTransaction::DISPUTE_STATUS_DISPUTED;
        }

        if (!DisputeTransaction::insert($pivot)) {
            dd('error while creating dispute');
        }

        //return dispute id
        return $dispute->id;
    }

    public function handleDisputeManual($disputeTransaction, $request)
    {
        $disputeTransaction->dispute_status = $request->status;
        $disputeTransaction->description =$request->description;
        $disputeTransaction->disputed_amount =$request->dispute_amount;
        $disputeTransaction->cleared_clearance_id =$request->clearance_id;
        $disputeTransaction->save();

        $clearanceTransaction = ClearanceTransaction::whereClearanceId($disputeTransaction->dispute->disputed_clearance_id)
            ->whereTransactionId($disputeTransaction->transaction_id)
            ->first();
        $clearanceTransaction->dispute_status = null;
        $clearanceTransaction->save();

        if ($disputeTransaction->dispute->dispute_transaction_count !== 0 && $disputeTransaction->dispute_status != DisputeTransaction::DISPUTE_STATUS_DISPUTED) {
            $disputeTransaction->dispute->dispute_transaction_count = $disputeTransaction->dispute->dispute_transaction_count - 1;
            if ( $disputeTransaction->dispute->dispute_transaction_count === 0) {
                $disputeTransaction->dispute->status = 'HANDLED';
                $clearance = Clearance::where('id', $disputeTransaction->dispute->disputed_clearance_id)
                    /*->update(['dispute_status' => null, 'clearance_status' => 0])*/
                    ->first();

                $clearance->dispute_status = null;
                $clearance->clearance_status = Clearance::STATUS_CLEARED;
                $clearance->save();

            }
            $disputeTransaction->dispute->save();
        }

        return $disputeTransaction;
    }


    public function handleDispute($clearanceId)
    {
        return $this->IDisputeBehaviour->handleDispute($clearanceId);
    }
}

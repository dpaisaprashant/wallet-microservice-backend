<?php

namespace App\Wallet\Clearance;
use App\Models\ClearanceTransaction;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use App\Wallet\Clearance\Interfaces\IClearance;
use App\Wallet\Clearance\Repository\NPayClearanceRepository;
use App\Wallet\Clearance\Repository\PayPointClearanceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Clearance
{
    private $IClearanceBehavior;

    public function __construct(IClearance $IClearanceBehavior)
    {
        $this->IClearanceBehavior = $IClearanceBehavior;
    }

    public function createClearance($date, $clearanceType){
        // Create Clearance
        // id, admin_id, clearance_date, clearance_type, clearance_status, disputeStatus, timestamp

        if($clearanceType == 'payPoint')
        {
            $repository = new PayPointClearanceRepository(new Request());
            $transactions = $repository->transactionsInDateRange($date);
            $transactionType = 'App\Models\UserTransaction';
            $commissionSum = (new UserTransaction())->getTotalCommission($transactions);
        }else {
            $repository = new NPayClearanceRepository(new Request());
            $transactions = $repository->transactionsInDateRange($date);
            $transactionType = 'App\Models\UserLoadTransaction';
            $commissionSum = (new UserLoadTransaction())->getTotalCommission($transactions);
        }

        if (count($transactions) == 0) {
            dd('no transactions for the date range');
        }

        try {
            $clearance = \App\Models\Clearance::create([
                'admin_id' => auth()->user()->id,
                'dispute_status' => null,
                'clearance_status' => null,
                'total_transaction_count' => count($transactions),
                'total_transaction_amount' => $transactions->sum('amount') * 100, //convert to paisa
                'total_transaction_commission' => $commissionSum * 100,
                'transaction_to_date' => $date['to'],
                'transaction_from_date' => $date['from'],
                'clearance_type' => $clearanceType,
                'created_at' => now()
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            dd("Error while creating clearance", $e);
        }


        // Create Pivot Table Clearance "clearance_transaction" => Polymorphic
        $pivot = [];
        foreach ($transactions as $key => $transaction) {
            $pivot[$key]['clearance_id'] = $clearance->id;
            $pivot[$key]['transaction_id'] = $transaction->id;
            $pivot[$key]['transaction_type'] = $transactionType;
            $pivot[$key]['dispute_status'] = null;
        }

        if (!ClearanceTransaction::insert($pivot)) {
            DB::rollBack();
            dd('clearance failed try again');
        }

        return $clearance->id;
    }


    public function checkDateOfUploadedFile($thirdPartyTransactionList, $date){
        return $this->IClearanceBehavior->checkDateOfUploadedFile($thirdPartyTransactionList, $date);
    }

    public function uploadTransaction($third_party_transaction_list, $clearanceId){
        return $this->IClearanceBehavior->uploadTransaction($third_party_transaction_list, $clearanceId);
    }

    public function isClearanceCorrect($clearanceId){
        return $this->IClearanceBehavior->isClearanceCorrect($clearanceId);
    }
    public function getDisputedTransactionList($clearanceId){
        return $this->IClearanceBehavior->getDisputedTransactionList($clearanceId);
    }
    public function getCorrectTransactionList($clearanceId){
        return $this->IClearanceBehavior->getCorrectTransactionList($clearanceId);
    }




}

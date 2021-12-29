<?php

namespace App\Wallet\TransactionClearance\Clearance\Repository;

use App\Models\Microservice\PreTransaction;
use App\Wallet\TransactionClearance\Clearance\contracts\ClearanceRepository;
use Illuminate\Http\Request;

class PreTransactionClearanceRepository implements ClearanceRepository
{
    private Request $request;

    public function __construct()
    {
        $this->request = request();
    }

    private int $length = 15;

    public function paginatedTransactions()
    {
        return PreTransaction::whereHas('transactionEvent', function ($query) {
            return $query->doesntHave('refundTransaction');
        })
            ->with(
                'transactionEvent.transactionable',
                'user',
                //'transactionEvent.commission',
                //'transactionEvent.commission.transactions',
            )
            ->latest()
            ->filter($this->request)
            ->paginate($this->length);
    }

    public function transactionsCount()
    {
        return PreTransaction::whereHas('transactionEvent', function ($query) {
            return $query->doesntHave('refundTransaction');
        })->filter($this->request)->count();
    }

    public function transactionAmountSum()
    {
        return PreTransaction::whereHas('transactionEvent', function ($query) {
                return $query->doesntHave('refundTransaction');
            })->filter($this->request)->sum('amount') / 100;
    }

    public function transactionFeeSum()
    {
        $preTransactions = PreTransaction::whereHas('transactionEvent', function ($query) {
            return $query->doesntHave('refundTransaction');
        })
            ->filter($this->request)
            ->get();
        //->sum('transactionEvent.fee');

        return $preTransactions->sum(fn ($preTransaction) => $preTransaction->transactionEvent->sum('amount'));
    }
}

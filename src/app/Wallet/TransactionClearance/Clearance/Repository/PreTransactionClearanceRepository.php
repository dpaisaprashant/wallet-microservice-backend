<?php

namespace App\Wallet\TransactionClearance\Clearance\Repository;

use App\Models\Microservice\PreTransaction;
use App\Wallet\TransactionClearance\Clearance\contracts\ClearanceRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PreTransactionClearanceRepository implements ClearanceRepository
{
    private Request $request;

    private Builder $preTransactionBuilder;

    public function __construct()
    {
        $this->request = request();
        $this->preTransactionBuilder = PreTransaction::whereHas('transactionEvent', function ($query) {
            return $query->doesntHave('refundTransaction');
        });
    }

    private int $length = 15;

    public function paginatedTransactions()
    {
        return $this->preTransactionBuilder
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
        return $this->preTransactionBuilder->filter($this->request)->count();
    }

    public function transactionAmountSum()
    {
        return $this->preTransactionBuilder->filter($this->request)->sum('amount') / 100;
    }

    public function transactionFeeSum()
    {
        $preTransactions = $this->preTransactionBuilder->filter($this->request)
            ->get();
        //->sum('transactionEvent.fee');

        return $preTransactions->filter(fn ($preTransaction) => $preTransaction->transactionEvent->fee);
    }
}

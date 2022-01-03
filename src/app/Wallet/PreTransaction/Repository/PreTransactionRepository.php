<?php


namespace App\Wallet\PreTransaction\Repository;

use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;
use App\Models\UserCheckPayment;
use App\Models\UserTransaction;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PreTransactionRepository
{
    use CollectionPaginate;

    private $request;

    private  $length = 150;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param int $length
     * @return PreTransactionRepository
     */
    public function setLength(int $length): PreTransactionRepository
    {
        $this->length = $length;
        return $this;
    }

    public function paginatedProblematicPayments()
    {
        $transactions = PreTransaction::where('transaction_type', 'debit')
            ->where('service_type', '!=', 'FUND_TRANSFER')
            ->where('service_type', '!=', 'FUND_REQUEST')
            ->where('service_type', '!=', 'BFI_LOAD')
            ->latest()
            ->filter($this->request)
            ->get()
            ->transform(function ($value, $key) {

                $responseTransaction = json_decode($value->json_response, true);
                Log::info($responseTransaction);
                if (isset($responseTransaction['transaction']) && isset($responseTransaction['transaction']['pre_transaction_status'])) {
                    $preTransactionStatus = $responseTransaction['transaction']['pre_transaction_status'];
                    if ($preTransactionStatus === true || $preTransactionStatus === false
                        || $preTransactionStatus === "false" || $preTransactionStatus === "true") {
                        return null;
                    }
                }
                return $value;
            })
            ->filter();


        return $this->collectionPaginate($this->length, $transactions, $this->request);
    }

    public function paginatedTransactionEventPreTransactions()
    {
        return PreTransaction::whereHas('transactionEvent', function ($query) {
            return $query->doesntHave('refundTransaction');
        })
            ->with(
                'transactionEvent.transactionable',
                'user',
                'transactionEvent.commission',
                'transactionEvent.commission.transactions',
            )
            ->latest()
            ->filter($this->request)
            ->paginate($this->length);
    }

    public function transactionEventPreTransactionCount()
    {
        return PreTransaction::whereHas('transactionEvent', function ($query) {
            return $query->doesntHave('refundTransaction');
        })->filter($this->request)->count();
    }

    public function transactionEventPreTransactionAmountSum()
    {
        return PreTransaction::whereHas('transactionEvent', function ($query) {
            return $query->doesntHave('refundTransaction');
        })->filter($this->request)->sum('amount') / 100;
    }

    public function transactionEventPreTransactionFeeSum()
    {
        return 0;
        $preTransactions = PreTransaction::whereHas('transactionEvent', function ($query) {
                return $query->doesntHave('refundTransaction');
            })
            ->filter($this->request)
            ->get();
            //->sum('transactionEvent.fee');

        return $preTransactions->sum(fn ($preTransaction) => $preTransaction->transactionEvent->sum('amount'));
    }
}

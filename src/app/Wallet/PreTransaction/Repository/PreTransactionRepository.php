<?php


namespace App\Wallet\PreTransaction\Repository;

use App\Models\Microservice\PreTransaction;
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
}

<?php


namespace App\Wallet\TransactionClearance\Clearance\Resolver;


use App\Models\KhaltiUserTransaction;
use App\Models\NchlAggregatedPayment;
use App\Models\NchlBankTransfer;
use App\Models\NchlLoadTransaction;
use App\Models\NICAsiaCyberSourceLoadTransaction;
use App\Models\NtcRetailerToCustomerTransaction;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use App\Wallet\TransactionClearance\Clearance\Strategy\KhaltiPaymentClearanceStrategy;
use App\Wallet\TransactionClearance\Clearance\Strategy\NchlAggregatedPaymentClearanceStrategy;
use App\Wallet\TransactionClearance\Clearance\Strategy\NchlBankTransferClearanceStrategy;
use App\Wallet\TransactionClearance\Clearance\Strategy\NchlLoadClearanceStrategy;
use App\Wallet\TransactionClearance\Clearance\Strategy\NicAsiaCybersourceClearanceStrategy;
use App\Wallet\TransactionClearance\Clearance\Strategy\NPayLoadClearanceStrategy;
use App\Wallet\TransactionClearance\Clearance\Strategy\NtcPaymentClearanceStrategy;
use App\Wallet\TransactionClearance\Clearance\Strategy\PaypointClearanceStrategy;
use App\Wallet\TransactionClearance\Clearance\Strategy\NpsLoadClearanceStrategy;

class ClearanceTransactionTypeResolver
{
    private $transactionType;

    public function __construct($transactionType)
    {
        $this->transactionType = $transactionType;
    }

    public function resolve()
    {
        switch ($this->transactionType) {
            case UserTransaction::class:
                return new PaypointClearanceStrategy();
            case KhaltiUserTransaction::class:
                return new KhaltiPaymentClearanceStrategy();
            case NchlAggregatedPayment::class:
                return new NchlAggregatedPaymentClearanceStrategy();
            case NchlBankTransfer::class:
                return new NchlBankTransferClearanceStrategy();
            case NchlLoadTransaction::class:
                return new NchlLoadClearanceStrategy();
            case NICAsiaCyberSourceLoadTransaction::class:
                return new NicAsiaCybersourceClearanceStrategy();
            case UserLoadTransaction::class:
                return new NPayLoadClearanceStrategy();
            case NtcRetailerToCustomerTransaction::class:
                return new NtcPaymentClearanceStrategy();
            case NpsLoadClearanceStrategy::class:
                return new NpsLoadClearanceStrategy();
        }
    }


}

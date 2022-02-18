<?php


namespace App\Wallet\Report\Repositories;


use App\Models\CellPayUserTransaction;
use App\Models\FundRequest;
use App\Models\KhaltiUserTransaction;
use App\Models\MerchantTransaction;
use App\Models\Microservice\PreTransaction;
use App\Models\NchlAggregatedPayment;
use App\Models\NchlBankTransfer;
use App\Models\NchlLoadTransaction;
use App\Models\NICAsiaCyberSourceLoadTransaction;
use App\Models\NPSAccountLinkLoad;
use App\Models\NtcRetailerToCustomerTransaction;
use App\Models\PaymentNepalLoadTransaction;
use App\Models\TransactionEvent;
use App\Models\UsedUserReferral;
use App\Models\UserLoadTransaction;
use App\Models\UserReferralBonusTransaction;
use App\Models\UserToUserFundTransfer;
use App\Models\UserTransaction;
use App\Wallet\Commission\Models\Commission;
use Illuminate\Http\Request;

class NonBankPaymentReportRepository extends AbstractReportRepository
{

    public function getBillPaymentNumber()
    {

        $billPaymentTotalNumber = TransactionEvent::whereIn('transaction_type', $this->billPayment)
            ->filter($this->request)
            ->count();

        return $billPaymentTotalNumber;
    }

    public function getBillPaymentValue()
    {
        $billPaymentTotalValue = TransactionEvent::whereIn('transaction_type', $this->billPayment)
            ->filter($this->request)
            ->sum('amount');
        return $billPaymentTotalValue;
    }

    public function getTransferNumber()
    {
        $transferTotalNumber = TransactionEvent::where('transaction_type', UserToUserFundTransfer::class)
            ->where('vendor', 'Transfer Fund')
            ->whereHas('preTransaction', function ($query) {
                return $query->where('transaction_type', PreTransaction::TRANSACTION_TYPE_DEBIT);
            })
            ->filter($this->request)
            ->count();
        $fundTotalRequestNumber = TransactionEvent::where('transaction_type', FundRequest::class)
            ->whereHas('preTransaction', function ($query) {
                return $query->where('transaction_type', PreTransaction::TRANSACTION_TYPE_DEBIT);
            })
            ->filter($this->request)
            ->count();
        return $transferTotalNumber + $fundTotalRequestNumber;
    }

    public function getTransferValue()
    {
        $transferTotalValue = TransactionEvent::where('transaction_type', UserToUserFundTransfer::class)
            ->where('vendor', 'Transfer Fund')
            ->whereHas('preTransaction', function ($query) {
                return $query->where('transaction_type', PreTransaction::TRANSACTION_TYPE_DEBIT);
            })
            ->filter($this->request)
            ->sum('amount');
        $fundTotalRequestValue = TransactionEvent::where('transaction_type', FundRequest::class)
            ->whereHas('preTransaction', function ($query) {
                return $query->where('transaction_type', PreTransaction::TRANSACTION_TYPE_DEBIT);
            })
            ->filter($this->request)
            ->sum('amount');
        return $transferTotalValue + $fundTotalRequestValue;
    }

    public function getCashInNumber()
    {
        $cashInTotalNumber = TransactionEvent::whereIn('transaction_type', $this->cashIn)
            ->filter($this->request)
            ->count();
        return $cashInTotalNumber;
    }

    public function getCashInValue()
    {
        $cashInTotalValue = TransactionEvent::whereIn('transaction_type', $this->cashIn)
            ->filter($this->request)
            ->sum('amount');
        return $cashInTotalValue;
    }

    public function getOfferNumber()
    {
        $cashBackOfferTotalNumber = TransactionEvent::where('service_type', 'CASHBACK')->where('transaction_type', Commission::class)
            ->filter($this->request)
            ->count();
        $referralTotalNumber = TransactionEvent::whereIn('transaction_type', [UsedUserReferral::class, UserReferralBonusTransaction::class])
            ->filter($this->request)
            ->count();
        return $cashBackOfferTotalNumber + $referralTotalNumber;
    }

    public function getOfferValue()
    {
        $cashBackOfferTotalValue = TransactionEvent::where('service_type', 'CASHBACK')
            ->where('transaction_type', Commission::class)
            ->filter($this->request)
            ->sum('amount');
        $referralTotalValue = TransactionEvent::whereIn('transaction_type', [UsedUserReferral::class, UserReferralBonusTransaction::class])
            ->filter($this->request)
            ->sum('amount');
        return $cashBackOfferTotalValue + $referralTotalValue;
    }

    public function getFeesChargesNumber()
    {
        $commissionTotalNumber = TransactionEvent::where('service_type', 'COMMISSION')
            ->where('transaction_type', Commission::class)
            ->filter($this->request)
            ->count();
        return $commissionTotalNumber;
    }

    public function getFeesChargesValue()
    {
        $commissionTotalValue = TransactionEvent::where('service_type', 'COMMISSION')->where('transaction_type', Commission::class)
            ->filter($this->request)
            ->sum('amount');
        return $commissionTotalValue;
    }

    public function getCashOutNumber()
    {
        $cashOutTotalNumber = TransactionEvent::where('transaction_type', NchlBankTransfer::class)
            ->filter($this->request)
            ->count();
        return $cashOutTotalNumber;
    }

    public function getCashOutValue()
    {
        $cashOutTotalValue = TransactionEvent::where('transaction_type', NchlBankTransfer::class)
            ->filter($this->request)
            ->sum('amount');
        return $cashOutTotalValue;
    }

    public function getBankTransferNumber()
    {
        return TransactionEvent::where('transaction_type', NchlBankTransfer::class)
            ->filter($this->request)
            ->count();
    }

    public function getBankTransferValue()
    {
        return TransactionEvent::where('transaction_type', NchlBankTransfer::class)
            ->filter($this->request)
            ->sum('amount');
    }

    public function getGovernmentPaymentNumber()
    {
        return TransactionEvent::where('transaction_type', NchlAggregatedPayment::class)
            ->filter($this->request)
            ->count();
    }

    public function getGovernmentPaymentValue()
    {
        return TransactionEvent::where('transaction_type', NchlAggregatedPayment::class)
            ->filter($this->request)
            ->sum('amount');
    }

    public function getTopUpNumber()
    {
        return TransactionEvent::whereIn('transaction_type', [UserTransaction::class, CellPayUserTransaction::class, NtcRetailerToCustomerTransaction::class])
            ->filter($this->request)
            ->count();
    }

    public function getTopUpValue()
    {
        return TransactionEvent::whereIn('transaction_type', [UserTransaction::class, CellPayUserTransaction::class, NtcRetailerToCustomerTransaction::class])
            ->filter($this->request)
            ->sum('amount');
    }



    public function checkCountMerchantTransactions()
    {

        $successfulCountMerchantTransactions = MerchantTransaction::where('status', 'COMPLETE')->filter($this->request)->count();
        $merchantTransactions = MerchantTransaction::filter($this->request)->count();

        $failedCountMerchantTransactions = $merchantTransactions - $successfulCountMerchantTransactions;

        $merchantTransactionsCount = ['successfulCountMerchantTransactions' => $successfulCountMerchantTransactions,
            'failedCountMerchantTransactions' => $failedCountMerchantTransactions,
        ];
        return $merchantTransactionsCount;
    }

    public function checkCountUserToUserFundTransfer()
    {
        $userToUserFundTransferCount = UserToUserFundTransfer::filter($this->request)->count();
        $fundRequestsCount = FundRequest::where('status',1)->filter($this->request)->count();
        $successfulCountUserToUserFundTransfer=$userToUserFundTransferCount+$fundRequestsCount;

        $failedCountUserToUserFundTransfer = 0;

        $userToUserFundTransferCount = ['successfulCountUserToUserFundTransfer' => $successfulCountUserToUserFundTransfer,
            'failedCountUserToUserFundTransfer' => $failedCountUserToUserFundTransfer,
        ];
        return $userToUserFundTransferCount;
    }

    public function checkCountKhaltiPayment()
    {

        $khaltiPayment = KhaltiUserTransaction::where('vendor', 'NCELL')->orWhere('vendor', 'NTC')->orWhere('vendor', 'SMARTCELL')->filter($this->request);
        $successfulCountKhaltiPayment=$khaltiPayment->where('state','success')->filter($this->request)->count();
        $failedCountKhaltiPayment = ($khaltiPayment->count()) - $successfulCountKhaltiPayment;

        $khaltiPaymentCount = ['successfulKhaltiPaymentCount' => $successfulCountKhaltiPayment,
            'failedKhaltiPaymentCount' => $failedCountKhaltiPayment,
        ];

        return $khaltiPaymentCount;
    }

    public function checkCountNchlAggregated()
    {

        $successfulCountNchlAggregated = TransactionEvent::where('transaction_type', NchlAggregatedPayment::class)->filter($this->request)->count();
        $nchlAggregated = NchlAggregatedPayment::filter($this->request)->count();

        $failedCountNchlAggregated = $nchlAggregated - $successfulCountNchlAggregated;

        $nchlAggregatedCount = ['successfulNchlAggregatedCount' => $successfulCountNchlAggregated,
            'failedNchlAggregatedCount' => $failedCountNchlAggregated,
        ];
        return $nchlAggregatedCount;
    }

    public function checkCountNchlBankTransfer()
    {

        $successfulCountNchlBankTransfer = TransactionEvent::where('transaction_type', NchlAggregatedPayment::class)->filter($this->request)->count();
        $nchlBankTransfer = NchlBankTransfer::filter($this->request)->count();

        $failedCountNchlBankTransfer = $nchlBankTransfer - $successfulCountNchlBankTransfer;

        $nchlBankTransferCount = ['successfulNchlBankTransferCount' => $successfulCountNchlBankTransfer,
            'failedNchlBankTransferCount' => $failedCountNchlBankTransfer,
        ];
        return $nchlBankTransferCount;
    }

    public function checkCountCashIn()
    {

        $successfulCountCashIn = $this->getCashInNumber();
        $totalCashInCount=UserLoadTransaction::filter($this->request)->count() +
            NchlLoadTransaction::filter($this->request)->count() +
            NICAsiaCyberSourceLoadTransaction::filter($this->request)->count() +
            NPSAccountLinkLoad::filter($this->request)->count();
//            PaymentNepalLoadTransaction::filter($this->request)->count();
        $failedCountCashIn = $totalCashInCount - $successfulCountCashIn;

        $cashInCount = ['successfulCashInCount' => $successfulCountCashIn,
            'failedCashInCount' => $failedCountCashIn,
        ];
        return $cashInCount;
    }

    public function checkCountCashOut()
    {

        $successfulCountCashOut = $this->getCashOutNumber();
        $totalCashOutCount=NchlBankTransfer::filter($this->request)->count();
        $failedCountCashOut = $totalCashOutCount - $successfulCountCashOut;

        $cashInCount = ['successfulCashOutCount' => $successfulCountCashOut,
            'failedCashOutCount' => $failedCountCashOut,
        ];
        return $cashInCount;
    }

}


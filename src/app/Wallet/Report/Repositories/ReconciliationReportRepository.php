<?php


namespace App\Wallet\Report\Repositories;


use App\Models\FundRequest;
use App\Models\KhaltiUserTransaction;
use App\Models\LoadTestFund;
use App\Models\MerchantTransaction;
use App\Models\NchlAggregatedPayment;
use App\Models\NchlBankTransfer;
use App\Models\NchlLoadTransaction;
use App\Models\NICAsiaCyberSourceLoadTransaction;
use App\Models\NpsLoadTransaction;
use App\Models\TransactionEvent;
use App\Models\UsedUserReferral;
use App\Models\UserLoadTransaction;
use App\Models\UserMerchantEventTicketPayment;
use App\Models\UserReferralBonusTransaction;
use App\Models\UserToUserFundTransfer;
use App\Models\UserTransaction;
use App\Models\Wallet;
use App\Wallet\Commission\Models\Commission;
use Illuminate\Http\Request;

class ReconciliationReportRepository extends AbstractReportRepository
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function totalPaypointTransactionAmount()
    {
        return TransactionEvent::where('transaction_type', UserTransaction::class)
            ->doesntHave('refundTransaction')
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalPaypointTransactionCount()
    {
        return TransactionEvent::where('transaction_type', UserTransaction::class)
            ->doesntHave('refundTransaction')
            ->filter($this->request)
            ->count();
    }

    public function totalKhaltiTransactionAmount()
    {
        return TransactionEvent::where('transaction_type', KhaltiUserTransaction::class)
            ->doesntHave('refundTransaction')
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalKhaltiTransactionCount()
    {
        return TransactionEvent::where('transaction_type', KhaltiUserTransaction::class)
            ->doesntHave('refundTransaction')
            ->filter($this->request)
            ->count();
    }

    public function totalNPayTransactionAmount()
    {
        return TransactionEvent::where('transaction_type', UserLoadTransaction::class)
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalNPayTransactionCount()
    {
        return TransactionEvent::where('transaction_type', UserLoadTransaction::class)
            ->filter($this->request)
            ->count();
    }

    //nchl
    public function totalNpsTransactionAmount()
    {
        return TransactionEvent::where('transaction_type', NpsLoadTransaction::class)
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalNpsTransactionCount()
    {
        return TransactionEvent::where('transaction_type', NpsLoadTransaction::class)
            ->filter($this->request)
            ->count();
    }

    public function totalCashbackAmount()
    {
        return TransactionEvent::where('transaction_type', Commission::class)
            ->where('service_type', Commission::SERVICE_TYPE_CASHBACK)
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalCashbackCount()
    {
        return TransactionEvent::where('transaction_type', Commission::class)
            ->where('service_type', Commission::SERVICE_TYPE_CASHBACK)
            ->filter($this->request)
            ->count();
    }

    public function totalCommissionAmount()
    {
        return TransactionEvent::where('transaction_type', Commission::class)
            ->where('service_type', Commission::SERVICE_TYPE_COMMISSION)
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalCommissionCount()
    {
        return TransactionEvent::where('transaction_type', Commission::class)
            ->where('service_type', Commission::SERVICE_TYPE_COMMISSION)
            ->filter($this->request)
            ->count();
    }

    public function totalWalletBalanceAmount()
    {
        return Wallet::sum('balance');
    }

    public function totalBonusBalanceAmount()
    {
        return Wallet::sum('bonus_balance');
    }

    public function totalWalletBalanceCount()
    {
        return Wallet::count();
    }

    public function totalTestFundsAmount()
    {
        return TransactionEvent::where('transaction_type', LoadTestFund::class)
            ->doesntHave('refundTransaction')
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalTestFundsCount()
    {
        return TransactionEvent::where('transaction_type', LoadTestFund::class)
            ->doesntHave('refundTransaction')
            ->filter($this->request)
            ->count();
    }

    public function totalRefundAmount()
    {
        return TransactionEvent::where('transaction_type', LoadTestFund::class)
            ->whereHas('refundTransaction')
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalRefundCount()
    {
        return TransactionEvent::where('transaction_type', LoadTestFund::class)
            ->whereHas('refundTransaction')
            ->filter($this->request)
            ->count();
    }

    public function totalReferralAmount()
    {
        return TransactionEvent::whereIn('transaction_type', [UsedUserReferral::class, UserReferralBonusTransaction::class])
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalReferralCount()
    {
        return TransactionEvent::whereIn('transaction_type', [UsedUserReferral::class, UserReferralBonusTransaction::class])
            ->filter($this->request)
            ->count();
    }


    public function totalNchlLoadAmount()
    {
        return TransactionEvent::where('transaction_type', NchlLoadTransaction::class)
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalNchlLoadCount()
    {
        return TransactionEvent::where('transaction_type', NchlLoadTransaction::class)
            ->filter($this->request)
            ->count();
    }

    public function totalNchlBankTransferAmount()
    {
        return TransactionEvent::where('transaction_type', NchlBankTransfer::class)
            ->doesntHave('refundTransaction')
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalNchlBankTransferCount()
    {
        return TransactionEvent::where('transaction_type', NchlBankTransfer::class)
            ->doesntHave('refundTransaction')
            ->filter($this->request)
            ->count();
    }

    public function totalNchlAggregatedPaymentAmount()
    {
        return TransactionEvent::where('transaction_type', NchlAggregatedPayment::class)
            ->doesntHave('refundTransaction')
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalNchlAggregatedPaymentCount()
    {
        return TransactionEvent::where('transaction_type', NchlAggregatedPayment::class)
            ->doesntHave('refundTransaction')
            ->filter($this->request)
            ->count();
    }

    public function totalNicAsiaCyberSourceLoadAmount()
    {
        return TransactionEvent::where('transaction_type', NICAsiaCyberSourceLoadTransaction::class)
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalNicAsiaCyberSourceLoadCount()
    {
        return TransactionEvent::where('transaction_type', NICAsiaCyberSourceLoadTransaction::class)
            ->filter($this->request)
            ->count();
    }

    public function totalUserToMerchantAmount()
    {
        return TransactionEvent::where('transaction_type', MerchantTransaction::class)
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalUserToMerchantCount()
    {
        return TransactionEvent::where('transaction_type', MerchantTransaction::class)
            ->filter($this->request)
            ->count();
    }


    public function totalRoundOffAmount()
    {
        return 0.005 * $this->totalRoundOffCount();
    }

    public function totalRoundOffCount()
    {
        return TransactionEvent::where('amount', 'like', '%.%')->filter($this->request)->count();
    }

    public function totalUserToMerchantEventTicketPaymentAmount()
    {
        return TransactionEvent::where('transaction_type', UserMerchantEventTicketPayment::class)
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalUserToMerchantEventTicketPaymentCount()
    {
        return TransactionEvent::where('transaction_type', UserMerchantEventTicketPayment::class)
            ->filter($this->request)
            ->count();
    }

    public function totalTransactionEventCount()
    {
        return TransactionEvent::whereNotIn('transaction_type', [UserToUserFundTransfer::class, FundRequest::class])->count();
    }


    public function totalLoadAmount()
    {
        return $this->totalNPayTransactionAmount() + $this->totalNpsTransactionAmount()
            + $this->totalCashbackAmount() + $this->totalReferralAmount()
            + $this->totalTestFundsAmount() + $this->totalNchlLoadAmount()
            + $this->totalRefundAmount()
            + $this->totalNicAsiaCyberSourceLoadAmount() + ($this->totalRoundOffAmount() * 100);
    }

    public function totalPaymentAmount()
    {
        return $this->totalPaypointTransactionAmount() + $this->totalNchlBankTransferAmount()
            + $this->totalCommissionAmount() + $this->totalUserToMerchantAmount()
            + $this->totalNchlAggregatedPaymentAmount() + $this->totalUserToMerchantEventTicketPaymentAmount()
            + $this->totalKhaltiTransactionAmount() + $this->totalRefundAmount();
    }

}

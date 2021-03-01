<?php


namespace App\Wallet\Report\Repositories;


use App\Models\FundRequest;
use App\Models\LoadTestFund;
use App\Models\NchlBankTransfer;
use App\Models\NchlLoadTransaction;
use App\Models\TransactionEvent;
use App\Models\UsedUserReferral;
use App\Models\UserLoadTransaction;
use App\Models\UserToUserFundTransfer;
use App\Models\UserTransaction;
use App\Models\Wallet;
use App\Wallet\Commission\Models\Commission;
use Illuminate\Http\Request;

class UserReconciliationReportRepository extends ReconciliationReportRepository
{
    protected $userId;

    public function __construct(Request $request, $userId)
    {
        $request->merge(['user_id' => $userId]);
        $this->userId = $userId;
        parent::__construct($request);
    }

    public function totalWalletBalanceCount()
    {
        return 1;
    }

    public function totalWalletBalanceAmount()
    {
        return Wallet::whereUserId($this->userId)->first()->getOriginal('balance');
    }

    public function totalUserReceivedFundsAmount()
    {
        $fundReceived = TransactionEvent::where('transaction_type', UserToUserFundTransfer::class)
            ->filter($this->request)
            ->where('vendor', 'Recieved Funds')
            ->sum('amount');

        $requestFundReceived =  TransactionEvent::where('transaction_type', FundRequest::class)
            ->filter($this->request)
            ->where('vendor', 'Recieved Funds')
            ->sum('amount');

        return $fundReceived + $requestFundReceived;
    }

    public function totalUserReceivedFundsCount()
    {
        $fundReceived = TransactionEvent::where('transaction_type', UserToUserFundTransfer::class)
            ->filter($this->request)
            ->where('vendor', 'Recieved Funds')
            ->count();

        $requestFundReceived =  TransactionEvent::where('transaction_type', FundRequest::class)
            ->filter($this->request)
            ->where('vendor', 'Recieved Funds')
            ->count();

        return $fundReceived + $requestFundReceived;
    }

    public function totalUserTransferredFundsAmount()
    {
        $fundReceived = TransactionEvent::where('transaction_type', UserToUserFundTransfer::class)
            ->filter($this->request)
            ->where('vendor', 'Transfer Funds')
            ->sum('amount');

        $requestFundReceived =  TransactionEvent::where('transaction_type', FundRequest::class)
            ->filter($this->request)
            ->where('vendor', 'Transfer Funds')
            ->sum('amount');

        return $fundReceived + $requestFundReceived;
    }

    public function totalUserTransferredFundsCount()
    {
        $fundReceived = TransactionEvent::where('transaction_type', UserToUserFundTransfer::class)
            ->filter($this->request)
            ->where('vendor', 'Transfer Funds')
            ->count();

        $requestFundReceived =  TransactionEvent::where('transaction_type', FundRequest::class)
            ->filter($this->request)
            ->where('vendor', 'Transfer Funds')
            ->count();

        return $fundReceived + $requestFundReceived;
    }

    public function totalLoadAmount()
    {
        return $this->totalNPayTransactionAmount() + $this->totalCashbackAmount()
            + $this->totalReferralAmount() + $this->totalTestFundsAmount()
            + $this->totalNchlLoadAmount() + $this->totalUserReceivedFundsAmount()
            + $this->totalRoundOffAmount();
    }

    public function totalPaymentAmount()
    {
        return $this->totalPaypointTransactionAmount() + $this->totalNchlBankTransferAmount()
            + $this->totalUserTransferredFundsAmount() + $this->totalCommissionAmount()
            + $this->totalUserToMerchantAmount();
    }
}

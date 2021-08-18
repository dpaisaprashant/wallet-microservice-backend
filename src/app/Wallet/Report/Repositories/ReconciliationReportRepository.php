<?php


namespace App\Wallet\Report\Repositories;


use App\Models\BfiGatewayExecutePayment;
use App\Models\BfiToUserFundTransfer;
use App\Models\CellPayUserTransaction;
use App\Models\FundRequest;
use App\Models\KhaltiUserTransaction;
use App\Models\LoadTestFund;
use App\Models\MerchantTransaction;
use App\Models\Microservice\PreTransaction;
use App\Models\NchlAggregatedPayment;
use App\Models\NchlBankTransfer;
use App\Models\NchlLoadTransaction;
use App\Models\NICAsiaCyberSourceLoadTransaction;
use App\Models\NPSAccountLinkLoad;
use App\Models\NpsLoadTransaction;
use App\Models\NtcRetailerToCustomerTransaction;
use App\Models\PaymentNepalLoadTransaction;
use App\Models\TransactionEvent;
use App\Models\UsedUserReferral;
use App\Models\User;
use App\Models\UserLoadTransaction;
use App\Models\UserMerchantEventTicketPayment;
use App\Models\UserReferralBonusTransaction;
use App\Models\UserToBfiFundTransfer;
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
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalPaypointTransactionCount()
    {
        return TransactionEvent::where('transaction_type', UserTransaction::class)
            ->filter($this->request)
            ->count();
    }

    public function totalKhaltiTransactionAmount()
    {
        return TransactionEvent::where('transaction_type', KhaltiUserTransaction::class)
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalKhaltiTransactionCount()
    {
        return TransactionEvent::where('transaction_type', KhaltiUserTransaction::class)
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
        return Wallet::filter($this->request)->sum('balance');
    }

    public function totalMainBalanceAmount(){
        return Wallet::filter($this->request)->sum('balance') + Wallet::filter($this->request)->sum('bonus_balance');
    }

    public function totalBonusBalanceAmount()
    {
        return Wallet::filter($this->request)->sum('bonus_balance');
    }

    public function totalWalletBalanceCount()
    {
        return Wallet::filter($this->request)->count();
    }

    public function totalTestFundsAmount()
    {
        return TransactionEvent::with('transactionable')->where('transaction_type',LoadTestFund::class)->whereHasMorph('transactionable',LoadTestFund::class,function ($query){

            return $query->where('pre_transaction_id',null);
        })->filter($this->request)->sum('amount');
    }

    public function totalTestFundsCount()
    {
        return TransactionEvent::where('transaction_type',LoadTestFund::class)->whereHasMorph('transactionable',LoadTestFund::class,function ($query){

            return $query->where('pre_transaction_id',null);
        })->filter($this->request)->count();
    }

    public function totalRefundAmount()
    {
        return TransactionEvent::with('transactionable')->where('transaction_type',LoadTestFund::class)
            ->whereHasMorph('transactionable',LoadTestFund::class,function ($query){
            return $query->where('pre_transaction_id','!=',null)->whereHas('transactionEvent');
        })->filter($this->request)->sum('amount');

    }



    public function totalRefundCount()
    {
        return TransactionEvent::with('transactionable')->where('transaction_type',LoadTestFund::class)
            ->whereHasMorph('transactionable',LoadTestFund::class,function ($query){
                return $query->where('pre_transaction_id','!=',null)->whereHas('transactionEvent');
            })->filter($this->request)->count();
    }

    public function totalRefundForFailureAmount(){
        return TransactionEvent::with('transactionable')->where('transaction_type',LoadTestFund::class)
            ->whereHasMorph('transactionable',LoadTestFund::class,function ($query){
                return $query->where('pre_transaction_id','!=',null)->doesntHave('transactionEvent');
            })->filter($this->request)->sum('amount');
    }

    public function totalRefundForFailureCount(){
        return TransactionEvent::with('transactionable')->where('transaction_type',LoadTestFund::class)
            ->whereHasMorph('transactionable',LoadTestFund::class,function ($query){
                return $query->where('pre_transaction_id','!=',null)->doesntHave('transactionEvent');
            })->filter($this->request)->count();
    }

    //CellPay
    public function totalCellPayCount(){
        return TransactionEvent::where('transaction_type',CellPayUserTransaction::class)
            ->filter($this->request)
            ->count();
    }

    public function totalCellPayAmount(){
        return TransactionEvent::where('transaction_type',CellPayUserTransaction::class)
            ->filter($this->request)
            ->sum('amount');
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
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalNchlBankTransferCount()
    {
        return TransactionEvent::where('transaction_type', NchlBankTransfer::class)
            ->filter($this->request)
            ->count();
    }

    public function totalNchlAggregatedPaymentAmount()
    {
        return TransactionEvent::where('transaction_type', NchlAggregatedPayment::class)
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalNchlAggregatedPaymentCount()
    {
        return TransactionEvent::where('transaction_type', NchlAggregatedPayment::class)
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

    public function totalUserSendToMerchantAmount()
    {
        $userSendToMerchantAmount = TransactionEvent::where('transaction_type',MerchantTransaction::class)->whereHas('preTransaction',function($query){
            return $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_DEBIT);
        })->filter($this->request)->sum('amount');

        return $userSendToMerchantAmount;

    }

    public function totalUserSendToMerchantCount()
    {
        $userSendToMerchantCount = TransactionEvent::where('transaction_type',MerchantTransaction::class)->whereHas('preTransaction',function($query){
            return $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_DEBIT);
        })->filter($this->request)->count();

        return $userSendToMerchantCount;
    }

    //Merchant receives from user
    public function totalMerchantReceiveFromUserAmount(){
        $merchantReceiveFromUserAmount = TransactionEvent::where('transaction_type',MerchantTransaction::class)->whereHas('preTransaction',function($query){
            return $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_CREDIT);
        })->filter($this->request)->sum('amount');

        return $merchantReceiveFromUserAmount;
    }

    public function totalMerchantReceiveFromUserCount(){
        $merchantReceiveFromUserCount = TransactionEvent::where('transaction_type',MerchantTransaction::class)->whereHas('preTransaction',function($query){
            return $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_CREDIT);
        })->filter($this->request)->count();

        return $merchantReceiveFromUserCount;
    }

    //BFI Credit
    public function totalBFICreditAmount(){

        $bfiCreditAmount = TransactionEvent::where('transaction_type',BfiGatewayExecutePayment::class)->whereHas('preTransaction',function($query){
            $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_CREDIT);
        })->filter($this->request)->sum('amount');

        return $bfiCreditAmount;
    }

    public function totalBFICreditCount(){
        $bfiCreditCount= TransactionEvent::where('transaction_type',BfiGatewayExecutePayment::class)->whereHas('preTransaction',function($query){
            $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_CREDIT);
        })->filter($this->request)->count();

        return $bfiCreditCount;
    }

    //BFI Debit
    public function totalBFIDebitAmount(){
        $bfiDebitAmount = TransactionEvent::where('transaction_type',BfiGatewayExecutePayment::class)->whereHas('preTransaction',function($query){
            $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_DEBIT);
        })->filter($this->request)->sum('amount');

        return $bfiDebitAmount;
    }

    public function totalBFIDebitCount(){
        $bfiDebitCount = TransactionEvent::where('transaction_type',BfiGatewayExecutePayment::class)->whereHas('preTransaction',function($query){
            $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_DEBIT);
        })->filter($this->request)->count();

        return $bfiDebitCount;
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

    //User to user fund transfer
    public function totalUserSendsBalanceToOtherUserAmount(){
        return TransactionEvent::where('transaction_type',UserToUserFundTransfer::class)->whereHas('preTransaction',function ($query){
            return $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_DEBIT);
        })->filter($this->request)->sum('amount');
    }

    public function totalUserSendsBalanceToOtherUserCount(){
        return TransactionEvent::where('transaction_type',UserToUserFundTransfer::class)->whereHas('preTransaction',function ($query){
            return $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_DEBIT);
        })->filter($this->request)->count();
    }

    public function totalUserRecevicesBalanceFromOtherUserAmount(){
        return TransactionEvent::where('transaction_type',UserToUserFundTransfer::class)->whereHas('preTransaction',function ($query){
            return $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_CREDIT);
        })->filter($this->request)->sum('amount');
    }

    public function totalUserRecevicesBalanceFromOtherUserCount(){
        return TransactionEvent::where('transaction_type',UserToUserFundTransfer::class)->whereHas('preTransaction',function ($query){
            return $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_CREDIT);
        })->filter($this->request)->count();
    }



    public function totalUserToUserFundTransferCount(){
        return TransactionEvent::where('transaction_type',UserToUserFundTransfer::class)->filter($this->request)->count();
    }

    //NTC direct
    public function totalNtcDirectCount(){
        return TransactionEvent::where('transaction_type',NtcRetailerToCustomerTransaction::class)
            ->filter($this->request)
            ->count();
    }

    public function totalNtcDirectAmount(){
        return TransactionEvent::where('transaction_type',NtcRetailerToCustomerTransaction::class)
            ->filter($this->request)
            ->sum('amount');
    }

    //Payment Nepal
    public function totalPaymentNepalAmount(){
        return TransactionEvent::where('transaction_type',PaymentNepalLoadTransaction::class)
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalPaymentNepalCount(){
        return TransactionEvent::where('transaction_type',PaymentNepalLoadTransaction::class)
            ->filter($this->request)
            ->count();
    }

    //NPS Account Linking
    public function totalNPSAccountLinkAmount(){
        return TransactionEvent::where('transaction_type',NPSAccountLinkLoad::class)
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalNPSAccountLinkCount(){
        return TransactionEvent::where('transaction_type',NPSAccountLinkLoad::class)
            ->filter($this->request)
            ->count();
    }

    //User send fund to bfi
    public function totaluserSendsFundToBfiAmount(){
        return TransactionEvent::where('transaction_type',UserToBfiFundTransfer::class)->whereHas('preTransaction',function($query){
            return $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_DEBIT);
        })->filter($this->request)->sum('amount');
    }

    public function totaluserSendsFundToBfiCount(){
        return TransactionEvent::where('transaction_type',UserToBfiFundTransfer::class)->whereHas('preTransaction',function($query){
            return $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_DEBIT);
        })->filter($this->request)->count();
    }

    public function totalBfiReceiveFundFromUserAmount(){
        return TransactionEvent::where('transaction_type',UserToBfiFundTransfer::class)->whereHas('preTransaction',function($query){
            return $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_CREDIT);
        })->filter($this->request)->sum('amount');
    }

    public function totalBfiReceiveFundFromUserCount(){
        return TransactionEvent::where('transaction_type',UserToBfiFundTransfer::class)->whereHas('preTransaction',function($query){
            return $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_CREDIT);
        })->filter($this->request)->count();
    }

    //Bfi to user fund transfer
    public function totalbfiSendFundToUserAmount(){
        return TransactionEvent::where('transaction_type',BfiToUserFundTransfer::class)->whereHas('preTransaction',function ($query){
            return $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_DEBIT);
        })->filter($this->request)->sum('amount');
    }

    public function totalbfiSendFundToUserCount(){
        return TransactionEvent::where('transaction_type',BfiToUserFundTransfer::class)->whereHas('preTransaction',function ($query){
            return $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_DEBIT);
        })->filter($this->request)->count();
    }

    public function totalUserReceiveFundFromUserAmount(){
        return TransactionEvent::where('transaction_type',BfiToUserFundTransfer::class)->whereHas('preTransaction',function($query){
           return $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_CREDIT);
        })->filter($this->request)->sum('amount');
    }

    public function totalUserReceiveFundFromUserCount(){
        return TransactionEvent::where('transaction_type',BfiToUserFundTransfer::class)->whereHas('preTransaction',function($query){
            return $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_CREDIT);
        })->filter($this->request)->count();
    }

    //BFI Load
    public function totalBFILoadAmount(){
        return TransactionEvent::where('transaction_type');
    }

    //Credit Transactions
    public function totalLoadAmount()
    {
        return $this->totalNPayTransactionAmount() + $this->totalNpsTransactionAmount()
            + $this->totalCashbackAmount() + $this->totalReferralAmount()
            + $this->totalTestFundsAmount() + $this->totalNchlLoadAmount()
            + $this->totalNicAsiaCyberSourceLoadAmount() + ($this->totalRoundOffAmount() * 100) + $this->totalPaymentNepalAmount() +
            $this->totalNPSAccountLinkAmount() + $this->totalMerchantReceiveFromUserAmount()
            + $this->totalBFICreditAmount() + $this->totalUserReceiveFundFromUserAmount() + $this->totalBfiReceiveFundFromUserAmount()
            +$this->totalRefundAmount()+$this->totalUserRecevicesBalanceFromOtherUserAmount();
    }

    //Debit Transaction
    public function totalPaymentAmount()
    {
        return $this->totalPaypointTransactionAmount() + $this->totalNchlBankTransferAmount()
            + $this->totalCommissionAmount() + $this->totalUserSendToMerchantAmount()
            + $this->totalNchlAggregatedPaymentAmount() + $this->totalUserToMerchantEventTicketPaymentAmount()
            + $this->totalKhaltiTransactionAmount()+$this->totalCellPayAmount()+$this->totalNtcDirectAmount()+$this->totalBFIDebitAmount()
         +$this->totaluserSendsFundToBfiAmount() +$this->totalbfiSendFundToUserAmount()+$this->totalUserSendsBalanceToOtherUserAmount();
    }


}

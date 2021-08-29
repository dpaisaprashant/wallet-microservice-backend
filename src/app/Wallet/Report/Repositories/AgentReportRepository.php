<?php


namespace App\Wallet\Report\Repositories;


use App\Models\Agent;
use App\Models\CellPayUserTransaction;
use App\Models\KhaltiUserTransaction;
use App\Models\MerchantTransaction;
use App\Models\NchlAggregatedPayment;
use App\Models\NchlBankTransfer;
use App\Models\TransactionEvent;
use App\Models\UserToUserFundTransfer;
use App\Models\UserTransaction;
use Illuminate\Http\Request;
use App\Models\Microservice\PreTransaction;

class AgentReportRepository extends AbstractReportRepository
{
    protected $agent;
    private $from;
    private $to;

    public function __construct(Request $request, Agent $agent = null)
    {
        parent::__construct($request);
        $this->agent = $agent;
        $this->from = date('Y-m-d', strtotime(str_replace(',', ' ', $request->from)));
        $this->to = date('Y-m-d', strtotime(str_replace(',', ' ', $request->to)));
    }

    public function totalSubAgent()
    {
        return Agent::where('created_by_id', $this->agent->user->id)
            ->where('status', Agent::STATUS_ACCEPTED)
            ->filter($this->request)
            ->count();
    }

    public function previousReportingBalance()
    {
        /*$currentBalance = $this->agent->user->wallet->getOriginal('balance');
        $userId = $this->agent->user_id;
        $this->request->merge(['user_id' => $userId, 'to' => $this->from, 'from' => null]);
        $repo = new UserReconciliationReportRepository($this->request, $userId);
        $beforeTransactionBalance = $repo->totalLoadAmount() - $repo->totalPaymentAmount();
        return $beforeTransactionBalance / 100;*/
        return 0;

    }

    public function totalBillPayment()
    {
        $userId = $this->agent->user_id;
        return TransactionEvent::where('user_id', $userId)
            ->whereIn('transaction_type', [KhaltiUserTransaction::class,NchlAggregatedPayment::class])
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalP2PTransfer()
    {
        $userId = $this->agent->user_id;
    /*    return TransactionEvent::where('user_id', $userId)
            ->where('transaction_type', UserToUserFundTransfer::class)
            ->filter($this->request)
            ->where('vendor', 'Transfer Funds')
            ->sum('amount');*/
        return TransactionEvent::where('user_id', $userId)
            ->where('transaction_type', MerchantTransaction::class)
            ->whereHas('preTransaction',function($query){
                return $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_DEBIT);
            })
            ->filter($this->request)
            ->sum('amount');
    }

    public function totalCashIn()
    {
        $userId = $this->agent->user_id;
    /*    return TransactionEvent::where('user_id', $userId)
            ->where('transaction_type', UserToUserFundTransfer::class)
            ->filter($this->request)
            ->where('vendor', 'Recieved Funds')
            ->sum('amount');*/

        return TransactionEvent::where('user_id', $userId)
            ->where('transaction_type', UserToUserFundTransfer::class)
            ->whereHas('preTransaction',function($query){
               return $query->where('transaction_type',PreTransaction::TRANSACTION_TYPE_DEBIT);
            })
            ->filter($this->request)
            ->sum('amount');
    }

    public function otherPayment()
    {
        return 0;
    }

    public function totalPayment()
    {
        return $this->totalBillPayment() + $this->totalP2PTransfer() + $this->totalCashIn() + $this->otherPayment();
    }

}

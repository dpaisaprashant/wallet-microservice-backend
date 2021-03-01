<?php


namespace App\Wallet\Dashboard\Repository;


use App\Models\Dispute;
use App\Models\DisputeHandler;
use App\Models\NchlLoadTransaction;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use App\Wallet\Dashboard\Interfaces\DashboardStatsRepositoryInterface;
use Illuminate\Http\Request;

class NchlLoadDashboardRepository implements DashboardStatsRepositoryInterface
{
    private $request;

    private $from;

    private $to;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    public function successfulTransactionBuilder()
    {
        return NchlLoadTransaction::whereDate('created_at', '>=', $this->from)
            ->whereDate('created_at', '<=', $this->to)
            ->whereStatus('SUCCESS');
    }

    public function pendingDisputeBuilder()
    {
        return Dispute::whereTransactionType(NchlLoadTransaction::class)
            ->where('user_dispute_status', '!=', Dispute::USER_DISPUTE_STATUS_CLEARED)
            ->whereDate('created_at', '>=', $this->from)
            ->whereDate('created_at', '<=', $this->to);
    }

    public function resolvedDisputeBuilder()
    {
        $handlerIds = DisputeHandler::whereDate('created_at', '>=', $this->from)
            ->whereDate('created_at', '<=', $this->to)->pluck('dispute_id');

        return Dispute::whereIn('id', $handlerIds)->whereTransactionType(NchlLoadTransaction::class)
            ->where('user_dispute_status', Dispute::USER_DISPUTE_STATUS_CLEARED);
    }

    public function stats()
    {
        return [
            'transaction' => [
                'amount' => $this->successfulTransactionBuilder()->sum('amount') /100,
                'count' => $this->successfulTransactionBuilder()->count(),
            ],
            'pendingDispute' => [
                'amount' => $this->disputeAmount($this->pendingDisputeBuilder()),
                'count' => $this->pendingDisputeBuilder()->count()
            ],
            'resolvedDispute' => [
                'amount' => $this->disputeAmount($this->resolvedDisputeBuilder()),
                'count' => $this->resolvedDisputeBuilder()->count()
            ]
        ];
    }

    public function disputes()
    {
        return Dispute::whereTransactionType(NchlLoadTransaction::class)
            ->where('user_dispute_status', '!=', Dispute::USER_DISPUTE_STATUS_CLEARED)->latest()->take(4)->get();
    }

    private function disputeAmount($builder)
    {
        $disputes = $builder->with('disputeable')->get();
        $sum = 0;
        foreach ($disputes as $dispute) {
            $sum += $dispute->disputeable->amount;
        }
        return $sum;
    }
}

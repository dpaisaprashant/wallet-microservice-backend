<?php


namespace App\Wallet\Dashboard\Repository;


use App\Models\Clearance;
use App\Models\Dispute;
use App\Models\DisputeHandler;
use App\Models\TransactionEvent;
use App\Models\NepalQrTransaction;
use App\Wallet\Dashboard\Interfaces\DashboardStatsRepositoryInterface;

class NepalQrDashboardRepository extends DashboardRepository implements DashboardStatsRepositoryInterface
{

    private $length = 3;

    private $from;

    private $to;

    public function setLength(int $length)
    {
        $this->length = $length;
        return $this;
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
        return NepalQrTransaction::whereDate('created_at', '>=', $this->from)
            ->whereDate('created_at', '<=', $this->to);
    }

    public function pendingDisputeBuilder()
    {
        return Dispute::whereTransactionType(NepalQrTransaction::class)
            ->where('user_dispute_status', '!=', Dispute::USER_DISPUTE_STATUS_CLEARED)
            ->whereDate('created_at', '>=', $this->from)
            ->whereDate('created_at', '<=', $this->to);
    }

    public function resolvedDisputeBuilder()
    {
        $handlerIds = DisputeHandler::whereDate('created_at', '>=', $this->from)
            ->whereDate('created_at', '<=', $this->to)->pluck('dispute_id');

        return Dispute::whereIn('id', $handlerIds)->whereTransactionType(NepalQrTransaction::class)
            ->where('user_dispute_status', Dispute::USER_DISPUTE_STATUS_CLEARED);
    }

    public function stats()
    {
        return [
            'transaction' => [
                'amount' => $this->successfulTransactionBuilder()->sum('amount') / 100,
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

    public function vendorTypeGraph()
    {
        return TransactionEvent::whereTransactionType(NepalQrTransaction::class)
            ->get()
            ->groupBy('vendor')
            ->transform(function ($value, $key) {
                return count($value);
            });
    }

    public function clearances()
    {
        return Clearance::with('clearanceTransactions')->whereClearanceType(Clearance::TYPE_NEPALQR)->latest()->take(4)->get();
    }

    public function disputes()
    {
        return Dispute::whereTransactionType(NepalQrTransaction::class)
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

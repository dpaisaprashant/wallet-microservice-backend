<?php


namespace App\Wallet\Dashboard\Repository;


use App\Models\Clearance;
use App\Models\ClearanceTransaction;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Models\UserKYC;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardRepository
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function totalKYCNotFilledUsersCount()
    {
        $user = new User();
        return count($user->kycNotFilledUsers()->get());
    }

    public function totalKYCFilledUsersCount()
    {
        $user = new User();
        $kycNotFilledUserCount = $this->totalKYCNotFilledUsersCount();
        return count($user->get()) - $kycNotFilledUserCount;
    }

    public function successfulTransactionCount()
    {
        return TransactionEvent::count();
    }

    public function successfulTransactionSum()
    {
        return TransactionEvent::sum('amount') / 100;
    }

    public function monthNPayTransactions($year, $month)
    {
        return (new TransactionEvent())
            ->selectedMonthTransactions($year, $month, UserLoadTransaction::class);
    }

    public function monthPayPointTransactions($year, $month)
    {
        return (new TransactionEvent())
            ->selectedMonthTransactions($year, $month, UserTransaction::class);
    }

    public function yearTransactionCounts($year)
    {
        return [
            'npay' => TransactionEvent::whereYear('created_at', '=', $year)->whereTransactionType('App\Models\UserLoadTransaction')->count(),
            'paypoint' => TransactionEvent::whereYear('created_at', '=', $year)->whereTransactionType('App\Models\UserTransaction')->count(),
        ];
    }

    public function yearTransactionSums($year)
    {
        return [
            'npay' => TransactionEvent::whereYear('created_at', '=', $year)->whereTransactionType('App\Models\UserLoadTransaction')->sum('amount') / 100,
            'paypoint' => TransactionEvent::whereYear('created_at', '=', $year)->whereTransactionType('App\Models\UserTransaction')->sum('amount') / 100
        ];
    }


    public function transactionGraph($transactions)
    {
        $groupedTransactions =  $transactions
            ->groupBy(function ($val) {
                return Carbon::parse($val->created_at)->format('Y-m-d');
            });

        return $groupedTransactions->transform(function ($value, $key) {
            return [
                'count' => round(count($value), 0),
                'amount' => round($value->sum('amount'), 2),
                'userCount' =>  round($value->groupBy('user_id')->count(), 0) //number of unique users involved
            ];
        });
    }
}

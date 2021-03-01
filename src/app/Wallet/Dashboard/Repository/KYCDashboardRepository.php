<?php


namespace App\Wallet\Dashboard\Repository;


use App\Models\User;
use App\Models\UserKYC;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KYCDashboardRepository extends DashboardRepository
{

    private $kyc;

    public function __construct()
    {
        $this->kyc = new UserKYC();
    }

    public function totalAcceptedKYC()
    {
        return $this->kyc->whereAccept(1)->count();
    }

    public function totalRejectedKYC()
    {
        return $this->kyc->whereAccept(0)->count();
    }

    public function totalUnverifiedKYC()
    {
        return $this->kyc->whereAccept(null)->count();
    }

    public function pieChartKYC()
    {
        return [
            'Not Filled KYC' => count($this->kyc->notFilledKYC()),
            'Accepted KYC' => ($this->totalAcceptedKYC()),
            'Rejected KYC' => $this->totalRejectedKYC(),
            'Unverified KYC' => count($this->kyc->unverifiedKYC()),
        ];
    }

    public function graphUsers()
    {
        $year = Carbon::now()->format('Y');
        $groupedUsers =  User::whereYear('created_at', '=', $year)->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->created_at)->format('F');
            });

        return $groupedUsers->transform(function ($value, $key) {
            return [
                'count' => count($value),
            ];
        });
    }

    public function latestKYCs()
    {
        return $this->kyc->with('user')->latest()->take(5)->get();
    }


}

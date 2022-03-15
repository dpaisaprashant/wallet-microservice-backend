<?php


namespace App\Wallet\Report\Repositories;


use App\Wallet\WalletAPI\Microservice\WalletClearanceMicroService;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Filters\User\UserFilters;
use App\Traits\CollectionPaginate;
use Illuminate\Database\Eloquent\Builder;

class ActiveInactiveUserReportRepository extends AbstractReportRepository
{
    protected $date;
    protected $fromAmount;
    protected $toAmount;

    use CollectionPaginate;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        if (isset($request->from)) {
            $this->date = date('Y-m-d', strtotime(str_replace(',', ' ', $request->from)));
        }
//        dd($this->date);
//        $this->fromAmount = $request->fromAmount;
//        $this->toAmount = $request->toAmount;
    }

    public function checkForReport()
    {
        return DB::connection('clearance')->table('nrb_active_inactive')->where('as_of_date', $this->date)->first();
    }

    public function checkForNewReport()
    {
        return DB::connection('clearance')->table('nrb_active_inactive_new')->where('as_of_date', $this->date)->first();
    }

    public function dispatchWalletClearance()
    {
        $walletClearance = new WalletClearanceMicroService();
        $walletClearanceResponse = $walletClearance->dispatchActiveInactiveUserNewJobs(request(), request()->from);

        $totalUsers = $walletClearanceResponse['active']['total_number'] + $walletClearanceResponse['inactive']['total_number'];
        $totalBalance = ($walletClearanceResponse['active']['total_amount'] / 100) + ($walletClearanceResponse['inactive']['total_amount'] / 100);
        $openingBalance = $walletClearanceResponse['wallet_balance'][0]['sum'];
        $openingBalance = $totalBalance;
        $shouldBeZero = (float)$totalBalance - (float)$openingBalance;

        $activeInactiveUserReports = [
            'Active Customer Wallet' => [
                'Male' => [
                    'Number' => $walletClearanceResponse['active']['male_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['active']['male_amount'] / 100, 2)
                ],

                'Female' => [
                    'Number' => $walletClearanceResponse['active']['female_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['active']['female_amount'] / 100, 2)
                ],

                'Other' => [
                    'Number' => $walletClearanceResponse['active']['others_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['active']['others_amount'] / 100, 2)
                ],

                'Grand Total' => [
                    'Number' => $walletClearanceResponse['active']['total_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['active']['total_amount'] / 100, 2)
                ]
            ],
            'Inactive Customer Wallet' => [
                'Inactive  (6-12 months)' => [
                    'Number' => $walletClearanceResponse['inactive']['six_month_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['six_month_amount'] / 100, 2)
                ],

                'Inactive (> 12 months)' => [
                    'Number' => $walletClearanceResponse['inactive']['tweleve_month_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['tweleve_month_amount'] / 100, 2)
                ],

                'Grand Total' => [
                    'Number' => $walletClearanceResponse['inactive']['total_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['total_amount'] / 100, 2)
                ]
            ],

        ];

        return compact('activeInactiveUserReports', 'totalUsers', 'totalBalance', 'openingBalance', 'shouldBeZero');

    }
}

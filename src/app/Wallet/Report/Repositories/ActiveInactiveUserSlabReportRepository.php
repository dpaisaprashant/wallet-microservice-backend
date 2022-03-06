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

class ActiveInactiveUserSlabReportRepository extends AbstractReportRepository
{
    protected $date;
    protected $fromAmount;
    protected $toAmount;

    use CollectionPaginate;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        if($request->all()!=null) {
            $this->date = date('Y-m-d', strtotime(str_replace(',', ' ', $request->from)));
            $this->fromAmount = $request->fromAmount * 100;
            $this->toAmount = $request->toAmount * 100;
        }
    }

    public function checkForReport(){
        return DB::connection('clearance')->table('active_inactive_slab')->where('as_of_date', $this->date)->where('slab_from', $this->fromAmount)->where('slab_to', $this->toAmount)->first();
    }

    public function dispatchWalletClearance(){

        $walletClearance = new WalletClearanceMicroService();
        $walletClearanceResponse = $walletClearance->dispatchActiveInactiveUserSlabJobs(request());
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

//                'Grand Total' => [
//                    'Number' => $walletClearanceResponse['active']['total_number'],
//                    'Total Balance' => 'Rs. '.$walletClearanceResponse['active']['total_amount']
//                ]
            ],
            'Inactive Customer Wallet' => [
                'Inactive Male upto 6 Months' => [
                    'Number' => $walletClearanceResponse['inactive']['upto_six_months_male_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['upto_six_months_male_amount'] / 100, 2)
                ],
                'Inactive Female upto 6 Months' => [
                    'Number' => $walletClearanceResponse['inactive']['upto_six_months_female_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['upto_six_months_female_amount'] / 100, 2)
                ],
                'Inactive Others upto 6 Months' => [
                    'Number' => $walletClearanceResponse['inactive']['upto_six_months_other_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['upto_six_months_other_amount'] / 100, 2)
                ],
                'Inactive Male (6-12 months)' => [
                    'Number' => $walletClearanceResponse['inactive']['six_months_male_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['six_months_male_amount'] / 100, 2)
                ],
                'Inactive Female (6-12 months)' => [
                    'Number' => $walletClearanceResponse['inactive']['six_months_female_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['six_months_female_amount'] / 100, 2)
                ],
                'Inactive Others (6-12 months)' => [
                    'Number' => $walletClearanceResponse['inactive']['six_months_other_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['six_months_other_amount'] / 100, 2)
                ],

                'Inactive Male (> 12 months)' => [
                    'Number' => $walletClearanceResponse['inactive']['twelve_months_male_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['twelve_months_male_amount'] / 100, 2)
                ],

                'Inactive Female (> 12 months)' => [
                    'Number' => $walletClearanceResponse['inactive']['twelve_months_female_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['twelve_months_female_amount'] / 100, 2)
                ],

                'Inactive Others (> 12 months)' => [
                    'Number' => $walletClearanceResponse['inactive']['twelve_months_other_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['twelve_months_other_amount'] / 100, 2)
                ],

//                'Grand Total' => [
//                    'Number' => $walletClearanceResponse['inactive']['total_number'],
//                    'Total Balance' => 'Rs. '.$walletClearanceResponse['inactive']['total_amount']
//                ]
            ]
        ];

        return $activeInactiveUserReports;

    }
}

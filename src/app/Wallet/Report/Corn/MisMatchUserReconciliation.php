<?php
namespace App\Wallet\Report\Corn;

use App\Models\User;
use App\Wallet\Report\Http\Controllers\MismatchedUserBalanceController;
use App\Wallet\Report\Repositories\AbstractReportRepository;
use App\Wallet\Report\Repositories\MismatchedUserBalanceRepository;
use App\Wallet\Report\Repositories\ReconciliationReportRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class MisMatchUserReconciliation
{
    public function __invoke(Request $request){
        Log::info("Checking mismatch reconciliation");
        $userIds = [2604,2198,1976,1965,1935,1893,1863,1801,1751,1712,1675,1654,1594,1500,1470,1435,1432,1414,1332,1314,1285,1279,1235,1178,1157,1133,1099,1093,964,957,949,938,922,916,764,746,591,508,435,434,433,431,429,428,427,425,424,421,357,197,172,171,152,98,89,85,84,42,29,19,18,9,7,6,4];
        $users = User::with('wallet')->whereIn('id', $userIds)->latest()->get();
        $misMatchArray = [];
        $repository = new ReconciliationReportRepository(request());
        $decimalMismatch = [];
        $amountMismatch = [];

        foreach($users as $user){
            Log::info(" =========== checking for user: " . $user->mobile_no . " ===============");
            $totalWalletBalance = $user->wallet->main_balance; // balance + bonus_balance
            $walletBalance = $user->wallet->balance;
            $walletBonusBalance = $user->wallet->bonus_balance;
            $request->merge([
                'individual_user_number' => $user->mobile_no,
            ]);
            $repository = new ReconciliationReportRepository($request);

            $userMainBalance = $repository->totalLoadAmount() - $repository->totalPaymentAmount();
            if($totalWalletBalance != $userMainBalance){
                Log::info("mismatch for user: " . $user->mobile_no);
                Log::info("Wallet Balance: " . ($walletBalance * 100));
                Log::info("Wallet Bonus Balance: " . ($walletBonusBalance * 100));
                Log::info("Wallet total Balance: " . $totalWalletBalance);
                Log::info("Reconciliation balance: " . $userMainBalance);

                $misMatchArray[] = array(
                    'walletTotalBalance' => $totalWalletBalance / 100,
                    'userMainBalance' => $userMainBalance / 100,
                    'mobileNumber' => $user->mobile_no,
                    'userId' => $user->id
                );


                $diff = $totalWalletBalance - $userMainBalance;
                if ($diff < 0) $diff = $diff * -1;
                if ($diff < 1) {
                    array_push($decimalMismatch, $user->id);
                } else {
                    array_push($amountMismatch, $user->id);
                }

            }
            Log::info("==================================================================");

        }

        $misMatchUserIds = [];
        foreach($misMatchArray as $key=>$value){
            array_push($misMatchUserIds, $value['userId']);
            \Log::info(
                [
                    'User Id:',
                    $value['userId'],

                    'Mobile Number:',
                    $value['mobileNumber'],

                    'Wallet Main Balance:',
                    $value['walletTotalBalance'],

                    'User Main Balance:',
                    $value['userMainBalance'],
                ]
            );
        }

        Log::info("Mismatch user id: ", $misMatchUserIds);
        Log::info("=======================================");
        Log::info("Decimal mismatch user id: ", $decimalMismatch);
        Log::info("=======================================");
        Log::info("Amount mismatch user id: ", $amountMismatch);

    }
}

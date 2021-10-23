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
        $users = User::with('wallet')->latest()->get();
        $misMatchArray = [];
        $repository = new ReconciliationReportRepository(request());


        foreach($users as $user){
            Log::info(" =========== checking for user: " . $user->mobile_no . " ===============");
            $walletMainBalance = $user->wallet->main_balance;
            $walletBonusBalance = $user->wallet->bonus_balance;
            $totalWalletBalance = $walletMainBalance + $walletBonusBalance;
            $request->merge([
                'individual_user_number' => $user->mobile_no,
            ]);
            $repository = new ReconciliationReportRepository($request);

            $userMainBalance = $repository->totalLoadAmount() - $repository->totalPaymentAmount();
            if($totalWalletBalance != $userMainBalance){
                Log::info("mismatch for user: " . $user->mobile_no);
                Log::info("Wallet Main Balance: " . $walletMainBalance);
                Log::info("Wallet Bonus Balance: " . $walletBonusBalance);
                Log::info("Reconciliation balance: " . $userMainBalance);

                $misMatchArray[] = array(
                    'walletMainBalance' => $walletMainBalance / 100,
                    'userMainBalance' => $userMainBalance / 100,
                    'mobileNumber' => $user->mobile_no,
                    'userId' => $user->id
                );
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
                    $value['walletMainBalance'],

                    'User Main Balance:',
                    $value['userMainBalance'],
                ]
            );
        }

        Log::info("Mismatch user id: ", $misMatchUserIds);

    }
}

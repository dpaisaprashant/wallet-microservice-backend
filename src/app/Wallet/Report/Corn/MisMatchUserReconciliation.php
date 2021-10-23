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

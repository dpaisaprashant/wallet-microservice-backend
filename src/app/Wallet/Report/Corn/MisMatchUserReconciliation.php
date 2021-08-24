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
        $users = User::with('wallet')->latest()->get();
        $misMatchArray = [];
        $repository = new ReconciliationReportRepository(request());


        foreach($users as $user){
            $walletMainBalance = $user->wallet->main_balance;
            $request->merge([
                'individual_user_number' => $user->mobile_no,
            ]);
            $repository = new ReconciliationReportRepository($request);

            $userMainBalance = $repository->totalLoadAmount() - $repository->totalPaymentAmount();
            if($walletMainBalance != $userMainBalance){
                $misMatchArray[] = array(
                    'walletMainBalance' => $walletMainBalance / 100,
                    'userMainBalance' => $userMainBalance / 100,
                    'mobileNumber' => $user->mobile_no,
                    'userId' => $user->id
                );
            }

        }


        foreach($misMatchArray as $key=>$value){
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

    }
}

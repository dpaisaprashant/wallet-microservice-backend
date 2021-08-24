<?php
namespace App\Wallet\Report\Corn;

use App\Wallet\Report\Http\Controllers\MismatchedUserBalanceController;
use App\Wallet\Report\Repositories\AbstractReportRepository;
use App\Wallet\Report\Repositories\MismatchedUserBalanceRepository;
use Illuminate\Support\Facades\Log;


class CheckUserBalanceMismatch
{
    public function __invoke()
    {
        $repository = new MismatchedUserBalanceRepository(request());
        $users = $repository->getMismatchedBalanceUser();
        foreach ($users as $user){
            Log::info('Mismatched User:',
                [
                    'User Id:',
                    $user->id,
                    'User Name:',
                    $user->name,
                    'User Number:',
                    $user->moble_no,
                    'User wallet balance:',
                    $user->wallet->balance,
                    'User latest Transaction balance:',
                    optional($user->latestUserTransactionEvent)->balance,
                    'User Wallet Bonus Balance:',
                    $user->wallet->bonus_balance,
                    'User latest Transaction bonus balance:',
                    optional($user->latestUserTransactionEvent)->bonus_balance,
                    'User latest Transaction Event id:',
                    optional($user->latestUserTransactionEvent)->id,
                    'User latest Transaction Event preTransactio Id:',
                    optional($user->latestUserTransactionEvent)->pre_transaction_id,
                ]);
        }
        //loop through users
        //send message to developer
    }
}

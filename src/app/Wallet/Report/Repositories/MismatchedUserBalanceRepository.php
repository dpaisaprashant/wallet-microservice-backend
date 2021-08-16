<?php


namespace App\Wallet\Report\Repositories;


use App\Models\User;

class MismatchedUserBalanceRepository extends AbstractReportRepository
{

    public function getMismatchedBalanceUser()
    {
        $users = User::filter(request())->with('latestUserTransactionEvent','wallet')
            ->get()
            ->transform(function ($user) {

                //if
                if ($user->latestUserTransactionEvent) {
                    if (($user->latestUserTransactionEvent->balance != $user->wallet->balance) || ($user->latestUserTransactionEvent->bonus_balance != $user->wallet->bonus_balance)) {
                        return $user;
                    }
                }
                else{
                    if(($user->wallet->balance > 0) || ($user->wallet->bonus_balance > 0)){
                        return $user;
                    }
                }
            })->filter();
//        dd($users);
        return $users;



        //check for missmatched users
        //return only mismatched users list

    }
}

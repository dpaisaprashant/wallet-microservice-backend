<?php


namespace App\Wallet\User\Repositories;


use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Models\UserBankAccount;
use App\Models\UserKYC;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserTotalTransactionRepository
{
    use CollectionPaginate;

    public function totalUserTransactions()
    {
        $users = User::with('preTransactions', 'userTransactionEvents')
            ->filter(request())
            ->whereHas('preTransactions', function ($q) {
                return $q->where('status', PreTransaction::STATUS_SUCCESS);
            })
            ->get();

        foreach ($users as $user) {
            $user['debit_sum'] = $user['preTransactions']
                ->where('transaction_type', 'debit')
                ->sum('amount');

            $user['debit_count'] = $user['preTransactions']
                ->where('transaction_type', 'debit')
                ->count();

            $user['credit_sum'] = $user['preTransactions']
                ->where('transaction_type', 'credit')
                ->sum('amount');

            $user['credit_count'] = $user['preTransactions']
                ->where('transaction_type', 'credit')
                ->count();

            $user['cashback_sum'] = $user->userTransactionEvents
                ->where('transaction_type', 'App\Wallet\Commission\Models\Commission')
                ->where('service_type', 'CASHBACK')
                ->sum('amount');

            $user['cashback_count'] = $user->userTransactionEvents
                ->where('transaction_type', 'App\Wallet\Commission\Models\Commission')
                ->where('service_type', 'CASHBACK')
                ->count();

            $user['commission_sum'] = $user->userTransactionEvents
                ->where('transaction_type', 'App\Wallet\Commission\Models\Commission')
                ->where('service_type', 'COMMISSION')
                ->sum('amount');

            $user['commission_count'] = $user->userTransactionEvents
                ->where('transaction_type', 'App\Wallet\Commission\Models\Commission')
                ->where('service_type', 'COMMISSION')
                ->count();

        }
//dd($users);
        if (request()->sortTotal === 'total_credit_amount') {

            $users = $users->sortByDesc('credit_sum');

        } elseif (request()->sortTotal === 'total_debit_amount') {

            $users = $users->sortByDesc('debit_sum');

        } elseif (request()->sortTotal === 'total_credit_count') {

            $users = $users->sortByDesc('credit_count');

        } elseif (request()->sortTotal === 'total_debit_count') {

            $users = $users->sortByDesc('debit_count');

        } elseif (request()->sortTotal === 'total_cashback_count') {

            $users = $users->sortByDesc('cashback_count');

        } elseif (request()->sortTotal === 'total_cashback_amount') {

            $users = $users->sortByDesc('cashback_sum');

        } elseif (request()->sortTotal === 'total_commission_amount') {

            $users = $users->sortByDesc('commission_sum');

        } elseif (request()->sortTotal === 'total_commission_count') {

            $users = $users->sortByDesc('commission_count');

        }

        return $this->collectionPaginate(10, $users, request());
    }

}

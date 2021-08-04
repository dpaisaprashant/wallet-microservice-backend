<?php

namespace App\Filters\LinkedAccounts;

use App\Filters\FilterAbstract;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserPhoneNumberFilter extends FilterAbstract {

    public function filter(Builder $builder, $value){
        if($value == null){
            return $builder;
        }
//        dd($value);

        $user = User::with('preTransaction')->where('mobile_no',$value)->first();
        dd($user);
        $preTransactionList = $user->preTransaction->pluck('pre_transaction_id');
        return $builder->whereIn('reference_id', $preTransactionList);
        // return $builder->where('user_phone_number','LIKE', "%{$value}%")->get();

    }
}

<?php

namespace App\Filters\NicAsia;

use App\Filters\FilterAbstract;
use App\Models\Microservice\PreTransaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends FilterAbstract {


    public function mapping()
    {
        return [

        ];
    }

    /**
     * Apply filter.
     *
     * @param Builder $builder
     * @param mixed $value
     *
     * @return Builder
     */
    public function filter(Builder $builder, $value)
    {
        //$value = $this->resolveFilterValue($value);
        if ($value === null) {
            return $builder;
        }

//        return $builder->whereHas('user', function ($query) use ($value){
//            $query->where(function ($query) use ($value) {
//                $query->where('email', $value)->orWhere('mobile_no', $value);
//            });
//        });
//        $user = User::has('preTransaction')->where('mobile_no',$value)->pluck('id');
//        $preTransactions = PreTransaction::where('user_id',$user)->pluck('pre_transaction_id');
////        dd($preTransactions);
//        return $builder->whereIn('pre_transaction_id', $preTransactions);

        $user = User::with('preTransaction')->where('mobile_no',$value)->first();
        $preTransactionList = $user->preTransaction->pluck('pre_transaction_id');
        return $builder->whereIn('pre_transaction_id', $preTransactionList);
    }
}

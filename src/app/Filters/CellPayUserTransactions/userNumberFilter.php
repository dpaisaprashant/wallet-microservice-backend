<?php

namespace App\Filters\CellPayUserTransactions;

use App\Filters\FilterAbstract;
use App\Models\Microservice\PreTransaction;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;

class userNumberFilter extends FilterAbstract {


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
//        dd($value);
//        return $builder->whereHas('preTransaction',function($query) use ($value){
//            $query->whereHas('user',function ($query) use ($value){
//                return $query->where('mobile_no',$value);
//            });
//        });
//        $user = User::has('preTransaction')->where('mobile_no',$value)->pluck('id');
//        $preTransactions = PreTransaction::where('user_id',$user)->pluck('pre_transaction_id');
//        dd($pretransactions);

        $user = User::with('preTransaction')->where('mobile_no',$value)->first();
        $preTransactionList = $user->preTransaction->pluck('pre_transaction_id');
        return $builder->whereIn('reference_no', $preTransactionList);
    }
}

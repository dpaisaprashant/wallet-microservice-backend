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

        $user = User::where('mobile_no',$value)->pluck('id');
        $preTransactions = PreTransaction::where('user_id',$user)->pluck('pre_transaction_id');
//        dd($pretransactions);
        return $builder->whereIn('reference_no', $preTransactions);
    }
}

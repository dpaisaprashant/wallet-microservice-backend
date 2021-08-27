<?php

namespace App\Filters\NchlAggregatedPayment;

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

        $userId = User::where('mobile_no',$value)->value('id');
        $preTransactionIds = PreTransaction::where('user_id',$userId)->pluck('pre_transaction_id');
        return $builder->whereIn('pre_transaction_id',$preTransactionIds);
    }
}

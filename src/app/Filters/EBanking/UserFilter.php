<?php

namespace App\Filters\EBanking;

use App\Filters\FilterAbstract;
use App\Models\Microservice\PreTransaction;
use App\Models\Microservice\RequestInfo;
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

        $user = User::where('email', $value)->orWhere('mobile_no', $value)->value('id');

        $preTransactionList = PreTransaction::whereUserId($user)->pluck('pre_transaction_id');
//        $requestInfoList = RequestInfo::whereUserId($user)->pluck('request_id');

        return $builder->whereIn('pre_transaction_id', $preTransactionList);
    }
}

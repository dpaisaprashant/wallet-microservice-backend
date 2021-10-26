<?php

namespace App\Filters\MerchantTransactions;

use App\Filters\FilterAbstract;
use App\Models\User;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
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
        if ($value === null) {
            return $builder;
        }

        $user = User::where('email', $value)->orWhere('mobile_no', $value)->pluck('id');
        return $builder->where('user_id', $user);
    }
}

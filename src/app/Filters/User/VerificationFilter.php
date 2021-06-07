<?php

namespace App\Filters\User;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class VerificationFilter extends FilterAbstract {


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
        }elseif($value == 'unverified'){
            return $builder->where('phone_verified_at',null);
        }elseif($value == 'all'){
            return $builder->where('id','!=',null);
        }else{
            return $builder->where('phone_verified_at', '!=',null);
        }

    }
}

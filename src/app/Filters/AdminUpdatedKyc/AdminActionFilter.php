<?php

namespace App\Filters\AdminUpdatedKyc;

use App\Filters\FilterAbstract;
use App\Models\Admin;
use App\Models\User;
use App\Models\UserKYC;
use Illuminate\Database\Eloquent\Builder;

class AdminActionFilter extends FilterAbstract {


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
        if ($value == "Created"){
            return $builder->whereNull('kyc_before_change');
        }else{
            return $builder->whereNotNull('kyc_before_change');
        }
    }
}

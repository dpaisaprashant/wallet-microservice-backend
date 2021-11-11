<?php

namespace App\Filters\User;

use App\Filters\FilterAbstract;
use App\Models\User;
use App\Models\UserKYC;
use Illuminate\Database\Eloquent\Builder;

class FromKYCDateFilter extends FilterAbstract {


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

        return $builder->whereHas('kyc',function ($query) use ($value) {
            return $query->whereDate('created_at', '>=' ,date('Y-m-d', strtotime(str_replace(',', ' ', $value))));
        });
    }
}

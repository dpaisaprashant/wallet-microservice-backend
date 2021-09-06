<?php

namespace App\Filters\NonRealTimeBankTransferFilter;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class CreditStatusFilter extends FilterAbstract {


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
        if($value == 'all'){
            return $builder->where('id','!=',null);
        }
        return $builder->where('credit_status',$value);
    }
}

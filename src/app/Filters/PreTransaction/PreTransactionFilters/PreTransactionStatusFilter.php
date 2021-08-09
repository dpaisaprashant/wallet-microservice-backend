<?php

namespace App\Filters\PreTransaction\PreTransactionFilters;


use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class PreTransactionStatusFilter extends FilterAbstract {


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
        if ($value == "SUCCESS"){
            return $builder->where("status","SUCCESS");
        }
        elseif($value == "FAILED"){
            return $builder->where("status","FAILED");
        }
        elseif($value == "NULL"){
            return $builder->where("status",null);
        }
    }
}

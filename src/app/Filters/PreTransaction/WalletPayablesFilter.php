<?php

namespace App\Filters\PreTransaction;


use App\Filters\FilterAbstract;
use App\Models\Microservice\PreTransaction;
use Illuminate\Database\Eloquent\Builder;

class WalletPayablesFilter extends FilterAbstract {


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
        if ($value == PreTransaction::BALANCE_STATUS_DEDUCTED){
            return $builder->where('balance_status','=',PreTransaction::BALANCE_STATUS_DEDUCTED);
        }elseif($value == PreTransaction::BALANCE_STATUS_REFUNDED){
            return $builder->where('balance_status','=',PreTransaction::BALANCE_STATUS_REFUNDED);
        }elseif($value == PreTransaction::BALANCE_STATUS_ADDED){
            return $builder->where('balance_status','=',PreTransaction::BALANCE_STATUS_ADDED);
        } elseif($value == "NULL"){
            return $builder->where('balance_status','=',null);
        }
    }
}

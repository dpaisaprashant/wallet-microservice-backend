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
        if ($value == "success_and_not_deducted"){
            return $builder->where('transaction_type','=',PreTransaction::TRANSACTION_TYPE_DEBIT)
                ->where('status','=',PreTransaction::STATUS_SUCCESS)
                ->where('balance_status','!=',PreTransaction::BALANCE_STATUS_DEDUCTED);
        }elseif($value == "failed_and_not_refunded"){
            return $builder->where('transaction_type','=',PreTransaction::TRANSACTION_TYPE_DEBIT)
                ->where('status','=',PreTransaction::STATUS_FAILED)
                ->where('balance_status','!=',PreTransaction::BALANCE_STATUS_REFUNDED);
        }elseif($value == "NULL"){
            return $builder->where('transaction_type','=',PreTransaction::TRANSACTION_TYPE_DEBIT)
                ->where('balance_status','=',null);
        }
    }
}

<?php

namespace App\Filters\NchlBankTransfer;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class CompareApiStatusFilter extends FilterAbstract {

    public function mapping()
    {

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
        //$value = $this->resolveFilterValue($this->mapping(), $value);
        if ($value === null) {
            return $builder;
        }

//        dd($value);

        if ($value == "NOT_MATCH") {
//            dd($)
//            dd($builder->where('debit_status','000')->get());
        }




        return $builder->where('credit_response_message', $value);
    }
}

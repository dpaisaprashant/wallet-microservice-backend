<?php

namespace App\Filters\CellPayUserTransactions;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class sortFilter extends FilterAbstract {


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
            return $builder->latest();
        }

        if ($value == "amount") {
            return $builder->orderBy('amount','DESC')->get();
        }
        elseif($value  == "date"){
            return $builder->orderBy('created_at','DESC')->get();
        }
    }
}

<?php

namespace App\Filters\CellPayUserTransactions;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class statusFilter extends FilterAbstract {


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
        if ($value == "true"){
            return $builder->where("status","true");
        }
        elseif($value == "false"){
            return $builder->where("status","false");
        }
        elseif($value == "null"){
            return $builder->where("status",null);
        }
    }
}

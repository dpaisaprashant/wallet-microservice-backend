<?php

namespace App\Filters\ClearanceTransaction;

use App\Filters\FilterAbstract;
use App\Models\UserTransaction;
use Illuminate\Database\Eloquent\Builder;

class StatusFilter extends FilterAbstract {

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
        //$value = $this->resolveFilterValue($this->mapping(), $value);
        if ($value === null) {
            return $builder;
        }


        if ($value == 'cleared') {
            $builder->where(function ($query){
                return $query->where('dispute_status', '=', 0)->orWhere('dispute_status', '=',null);
            });
        } elseif ($value == 'dispute') {
            $builder->where('dispute_status', '=', 1);
        }

        return $builder;
    }
}

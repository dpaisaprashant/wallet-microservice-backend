<?php

namespace App\Filters\NEASettlement;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class FromDateFilter extends FilterAbstract
{

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

        $value_converted = date("Y-m-d",strtotime(str_replace(',', ' ', $value)));
//        $month = date('m',$value_converted);
//        $year = date('Y',$value_converted);
//        return $builder->whereMonth('created_at',$month)->whereYear('created_at',$year);
        return $builder->whereDate('created_at','=',$value_converted);
    }
}

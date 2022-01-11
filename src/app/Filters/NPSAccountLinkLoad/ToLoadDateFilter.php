<?php

namespace App\Filters\NPSAccountLinkLoad;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class ToLoadDateFilter extends FilterAbstract {


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

        return $builder->whereRaw("STR_TO_DATE(?, '%d-%m-%Y')", '<= ?', [date('d-m-Y', strtotime($value))]);
        // return $builder->whereDate('load_time_stamp', '<=' ,date('Y-m-d', strtotime(str_replace(',', ' ', $value))));

    }
}

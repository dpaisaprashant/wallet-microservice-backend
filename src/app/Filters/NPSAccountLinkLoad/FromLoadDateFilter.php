<?php

namespace App\Filters\NPSAccountLinkLoad;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class FromLoadDateFilter extends FilterAbstract {


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
        // date('d-m-Y', strtotime($user->from_date));
        // ->whereRaw('Date(created_at) = CURDATE()')->get();
        return $builder->whereRaw("(STR_TO_DATE(load_time_stamp,'%m/%d/%y'))");
        // return $builder->whereRaw('Date('load_time_stamp', '>=' ,date('Y-m-d', strtotime(str_replace(',', ' ', $value)))));
    }
}

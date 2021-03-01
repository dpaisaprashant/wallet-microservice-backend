<?php

namespace App\Filters\Transaction;

use App\Filters\FilterAbstract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class MonthFilter extends FilterAbstract {


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

            $now = Carbon::now();
            $year = $now->format('Y');
            $month = $now->format('m');

            return $builder->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month);
        }

        $selectedDate = explode('-', $value);

        $year = $selectedDate[0];
        $month = $selectedDate[1];


        return $builder->whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month);
    }
}

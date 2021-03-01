<?php

namespace App\Filters\FCMNotification;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class SendFromUserFilter extends FilterAbstract {


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

        return $builder->whereHas('admin', function ($query) use ($value){
            $query->where(function ($query) use ($value) {
                $query->where('email', $value)->orWhere('mobile_no', $value);
            });
        });
    }
}

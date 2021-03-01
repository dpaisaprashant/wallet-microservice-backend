<?php

namespace App\Filters\FCMNotification;

use App\Filters\FilterAbstract;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class SendToUserFilter extends FilterAbstract {


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

        if ($value == 'Group Message') {
            return $builder->where('user_id', 0);
        }

        $userId =  User::where(function ($query) use ($value) {
            $query->where('email', $value)->orWhere('mobile_no', $value);
        })->pluck('id');


        return $builder->whereIn('user_id', $userId);

    }
}

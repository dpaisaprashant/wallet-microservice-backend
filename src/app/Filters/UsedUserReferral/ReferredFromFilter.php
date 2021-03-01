<?php

namespace App\Filters\UsedUserReferral;

use App\Filters\FilterAbstract;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ReferredFromFilter extends FilterAbstract {


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

        $user = User::where(function ($query) use ($value) {
            $query->where('email', $value)->orWhere('mobile_no', $value);
        })->first();


        return $builder->where('referred_from', $user->id);
    }
}

<?php

namespace App\Filters\PreTransaction;


use App\Filters\FilterAbstract;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UsersFilter extends FilterAbstract {


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
//        return $builder->where('user_id',$value);
        $user = User::where('mobile_no',$value)->get();
        $user_id = $user->pluck('id');
        return $builder->whereIn('user_id', $user_id);
    }
}

<?php


namespace App\Filters\User;


use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class UserTypeFilter extends FilterAbstract
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
    public function filter(Builder $builder, $value){
        if ($value == "user"){
            return $builder->whereHas('userType')->whereDoesntHave('agent')->latest();
        }
        elseif ($value == "agent"){
            return $builder->whereHas('agent')->latest();
        }
        else{
            return $builder->latest();
        }
    }
}

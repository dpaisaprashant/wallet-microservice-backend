<?php


namespace App\Filters\UserKyc;


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
        if ($value == "normal_user"){
            return $builder->whereHas('user',function ($user){
                 $user->whereHas('userType')->whereDoesntHave('agent');
            })->latest();
        }
        elseif ($value == "agent"){
            return $builder->whereHas('user',function ($user){
                $user->whereHas('agent');
            })->latest();
        }
        else{
            return $builder->whereHas('user',function($user){
                $user->whereHas('merchant');
            })->latest();
        }
    }
}

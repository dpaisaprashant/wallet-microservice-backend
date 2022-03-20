<?php


namespace App\Filters\User;


use App\Filters\FilterAbstract;
use App\Models\Merchant\Merchant;
use Illuminate\Database\Eloquent\Builder;

class UserStatusFilter extends FilterAbstract
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

        if ($value === null) {
            return $builder;
        }

        if ($value == "activated"){
            return $builder->where('status','=',1);
        }elseif($value == "deactivated"){
            return $builder->where('status','=',0);
        }else{
            return $builder;
        }
    }
}

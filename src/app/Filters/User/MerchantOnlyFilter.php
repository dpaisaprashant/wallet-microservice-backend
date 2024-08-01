<?php


namespace App\Filters\User;


use App\Filters\FilterAbstract;
use App\Models\Merchant\Merchant;
use Illuminate\Database\Eloquent\Builder;

class MerchantOnlyFilter extends FilterAbstract
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
        return $builder->where('user_type_id','=',0);
    }
}

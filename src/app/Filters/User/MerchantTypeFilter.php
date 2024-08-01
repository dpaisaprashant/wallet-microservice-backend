<?php

namespace App\Filters\User;

use App\Filters\FilterAbstract;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantType;
use Illuminate\Database\Eloquent\Builder;

class MerchantTypeFilter extends FilterAbstract {


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
        if($value == 'all'){
            return $builder->where('id','!=',null);
        }
        $merchantUserId = Merchant::where('merchant_type_id',$value)->pluck('user_id');
        $builder->whereIn('id',$merchantUserId);

    }
}

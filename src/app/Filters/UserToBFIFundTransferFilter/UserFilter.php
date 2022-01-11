<?php

namespace App\Filters\UserToBFIFundTransferFilter;

use App\Filters\FilterAbstract;
use App\Models\BFI\BFIUser;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends FilterAbstract {

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
        //$value = $this->resolveFilterValue($this->mapping(), $value);
        if ($value === null) {
            return $builder;
        }

        $bfiUser = BFIUser::where('bfi_name',$value)->pluck('id');

        return $builder->where('user_id', $bfiUser);
    }
}

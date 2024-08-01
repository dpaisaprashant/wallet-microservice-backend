<?php

namespace App\Filters\AdminUserKYC;

use App\Filters\FilterAbstract;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder;

class AdminKycNameFilter extends FilterAbstract {


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
        $adminDetails = Admin::where('email',$value)->pluck('id');

        return $builder->whereIn('admin_id', $adminDetails);
    }
}

<?php

namespace App\Filters\AdminAlteredAgent;

use App\Filters\FilterAbstract;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder;

class AdminNameFilter extends FilterAbstract {


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
        $adminId = Admin::where('name',$value)->pluck('id');

        return $builder->whereIn('admin_id', $adminId);
    }
}

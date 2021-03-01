<?php

namespace App\Filters\Clearance;

use App\Filters\FilterAbstract;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder;

class ClearedByFilter extends FilterAbstract {


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

        $adminId = Admin::whereName($value)->first()->id;

        /*return $builder->whereHas('admin', function ($query) use ($value) {
            $query->where('name', $value);
        });*/
        return $builder->where('admin_id', $adminId);
    }
}

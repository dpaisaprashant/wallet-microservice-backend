<?php

namespace App\Filters\Dispute;

use App\Filters\FilterAbstract;
use App\Models\Dispute;
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
        //$value = $this->resolveFilterValue($value);
        if ($value === null) {
            return $builder;
        }

        $disputes = $builder->with('disputeable')->get();


        $disputeIds = [];
        foreach ($disputes as $key => $dispute) {
            if($dispute->disputeable->user['mobile_no'] === $value || $dispute->disputeable->user['email'] === $value) {
                array_push($disputeIds, $dispute->id);
            }
        }

        return $builder->whereIn('id', $disputeIds);

    }
}

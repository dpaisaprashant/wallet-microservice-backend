<?php

namespace App\Filters\SocialMediaChallenge;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class TitleFilter extends FilterAbstract {


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
        if ($value === null) {
            return $builder;
        }

        return $builder->where('title', 'LIKE', "%{$value}%");
    }
}

<?php

namespace App\Filters\SocialMediaChallengeUsers;

use App\Filters\FilterAbstract;
use App\Models\SocialMediaChallengeUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends FilterAbstract
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
    public function filter(Builder $builder, $value)
    {
        if ($value === null) {
            return $builder;
        }

        $users = User::where('name', 'LIKE', "%{$value}%")->pluck('id');
        return $builder->whereIn('user_id', $users);
    }
}

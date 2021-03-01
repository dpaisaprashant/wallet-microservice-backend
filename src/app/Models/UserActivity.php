<?php

namespace App\Models;

use App\Filters\UserActivities\UserActivityFilters;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserActivity extends Model
{
    use BelongsToUser;

    protected $table = "user_activities";
    protected $connection = 'dpaisa';

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new UserActivityFilters($request))->add($filters)->filter($builder);
    }
}

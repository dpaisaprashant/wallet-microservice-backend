<?php

namespace App\Models;

use App\Filters\UserLoginHistory\UserLoginHistoryFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserLoginHistory extends Model
{
    protected $table = 'user_login_histories';
    protected $connection = 'dpaisa';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new UserLoginHistoryFilters($request))->add($filters)->filter($builder);
    }
}

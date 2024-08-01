<?php

namespace App\Models;

use App\Filters\UserRegisteredByUser\UserRegisteredByUserFilters;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserRegisteredByUser extends Model
{
    use BelongsToUser;

    protected $connection = "dpaisa";
    protected $table = "registered_by_users";
    protected $guarded = [];

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new UserRegisteredByUserFilters($request))->add($filters)->filter($builder);
    }

    public function UserWhoRegistered(){
       return $this->belongsTo(User::class,'registered_by_id');
    }
}

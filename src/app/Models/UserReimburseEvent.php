<?php

namespace App\Models;

use App\Filters\ReimburseTransaction\ReimburseTransaction;
use App\Traits\BelongsToUser;
use App\Traits\MorphOneTransaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserReimburseEvent extends Model
{
    use BelongsToUser, MorphOneTransaction;

    protected $connection = 'dpaisa';

    protected $guarded = [];

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new ReimburseTransaction($request))->add($filters)->filter($builder);
    }

    public function reimburseable()
    {
        return $this->morphTo('reimburseable', 'transaction_type', 'transaction_id');
    }
}

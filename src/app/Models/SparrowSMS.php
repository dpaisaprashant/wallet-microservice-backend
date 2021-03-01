<?php

namespace App\Models;

use App\Filters\Sparrow\SparrowFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SparrowSMS extends Model
{
    protected $table = 'sparrow_sms';
    protected $connection = 'dpaisa';

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new SparrowFilters($request))->add($filters)->filter($builder);
    }
}

<?php

namespace App\Models;


use App\Filters\RequestInfo\RequestInfoFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class RequestInfo extends Model
{
    protected $connection='dpaisa';
    protected $table='request_infos';


    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new RequestInfoFilters($request))->add($filters)->filter($builder);
    }

}

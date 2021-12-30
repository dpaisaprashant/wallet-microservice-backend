<?php

namespace App\Models\MiracleInfoSms;

use App\Filters\MiracleInfo\MiracleInfoFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MiracleInfoSMS extends Model
{
    protected $table = 'miracle_info_sms';
    protected $connection = 'dpaisa';

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new MiracleInfoFilters($request))->add($filters)->filter($builder);
    }
}

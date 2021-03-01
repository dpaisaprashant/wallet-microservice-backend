<?php


namespace App\Models;

use App\Filters\BackendLog\BackendLogFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class BackendLog extends Activity
{

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new BackendLogFilters($request))->add($filters)->filter($builder);
    }
}

<?php

namespace App\Models;


use App\Filters\DeviceInfo\DeviceInfoFilters;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class DeviceInfo extends Model
{
    use BelongsToUser;

    protected $connection='dpaisa';
    protected $table='user_device_infos';

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new DeviceInfoFilters($request))->add($filters)->filter($builder);
    }
}

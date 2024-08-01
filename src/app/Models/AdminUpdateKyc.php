<?php

namespace App\Models;

use App\Filters\AdminUpdatedKyc\AdminUpdatedKYCFilters;
use App\Filters\FiltersAbstract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AdminUpdateKyc extends Model
{
    protected $connection = 'mysql';
    protected $guarded = [];
    protected $table = 'admin_update_kycs';

    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function userKyc(){
        return $this->belongsTo(UserKYC::class,'user_kyc_id');
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new AdminUpdatedKYCFilters($request))->add($filters)->filter($builder);
    }


}

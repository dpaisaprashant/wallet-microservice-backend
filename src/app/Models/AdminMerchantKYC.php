<?php

namespace App\Models;

use App\Filters\AdminUserKYC\AdminUserKYCFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AdminMerchantKYC extends Model
{
    protected $table = 'admin_merchant_k_y_c';
    protected $connection = 'mysql';

    const ACCEPTED = 'ACCEPTED';
    CONST REJECTED = 'REJECTED';

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new AdminUserKYCFilters($request))->add($filters)->filter($builder);
    }
}

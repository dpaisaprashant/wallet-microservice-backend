<?php

namespace App\Models;

use App\Filters\NonRealTimeBankTransferFilter\NonRealTimeBankTransferFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class NonRealTimeBankTransfer extends Model
{
    protected $connection = 'nchl';


    protected $table = 'non_real_time_nchl_bank_transfer';

    protected $guarded = [];

    public function backendNonRealTime(){
        return $this->setConnection('mysql')->hasOne(AdminNonRealTimeBankTransfer::class,'non_real_time_id','id');
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new NonRealTimeBankTransferFilters($request))->add($filters)->filter($builder);
    }




}


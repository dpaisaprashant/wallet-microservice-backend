<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Microservice\PreTransaction;
use App\Filters\NPSAccountLinkLoad\NPSAccountLinkLoadFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Traits\BelongsToUser;

class NPSAccountLinkLoad extends Model
{
    use BelongsToUser;

    protected $connection = 'nps-accountlink';
    protected $table = "load_wallet";

    // protected $casts = [
    //     "amount" => "integer",
    //     "load_time_stamp" => "datetime"
    // ];
    
    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new NPSAccountLinkLoadFilters($request))->add($filters)->filter($builder);
    }

  
    public function preTransaction(){
        return $this->belongsTo(PreTransaction::class,'reference_id','pre_transaction_id');
    }


}

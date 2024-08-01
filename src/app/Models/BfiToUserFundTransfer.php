<?php

namespace App\Models;

use App\Filters\BFI\BFIFilters;
use App\Models\BFI\BFIUser;
use App\Traits\BelongsToUser;
use App\Traits\MorphOneTransaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BfiToUserFundTransfer extends Model
{
    use BelongsToUser, MorphOneTransaction;

    protected $connection = "bfi";

    public function getAmountAttribute($amount){
        return ($amount/100);
    }

    public function bfiUser(){
        return $this->belongsTo(BFIUser::class,'user_id');
    }

    public function bfiCheckPayment(){
        return $this->belongsTo(BfiGatewayCheckPayment::class,'process_id','process_id');
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new BFIFilters($request))->add($filters)->filter($builder);
    }

}

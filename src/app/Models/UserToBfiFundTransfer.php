<?php

namespace App\Models;

use App\Filters\FiltersAbstract;
use App\Filters\UserToBFIFundTransferFilter\UserToBFIFundTransferFilters;
use App\Models\BFI\BFIUser;
use App\Models\Merchant\MerchantBFI;
use App\Traits\BelongsToUser;
use App\Traits\MorphOneTransaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserToBfiFundTransfer extends Model
{
    use MorphOneTransaction;

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

    public function user()
    {
        return $this->belongsTo(User::class, 'wallet_id', 'mobile_no');
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new UserToBFIFundTransferFilters($request))->add($filters)->filter($builder);
    }


}

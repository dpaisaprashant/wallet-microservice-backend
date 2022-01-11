<?php

namespace App\Models\BFI;

use App\Filters\Agent\AgentFilters;
use App\Filters\FiltersAbstract;
use App\Models\Merchant\MerchantBFI;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BFIUser extends Model
{
    use BelongsToUser;

    protected $connection = "bfi";

    protected $guarded = [];

    protected $table = 'users';


    public function UserApiDetail(){
        return $this->hasOne(UserApiDetail::class,'user_id');
    }

    public function UserApprovedIp(){
        return $this->hasMany(UserApprovedIp::class,'user_id');
    }

    public function bfiMerchant(){
        return $this->belongsTo(MerchantBFI::class,'bfi_id','bfi_id');
    }
}

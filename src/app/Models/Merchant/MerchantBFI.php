<?php

namespace App\Models\Merchant;

use App\Filters\Agent\AgentFilters;
use App\Filters\FiltersAbstract;
use App\Models\BFI\BFIUser;
use App\Traits\BelongsToMerchant;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Activitylog\Traits\LogsActivity;

class MerchantBFI extends Model
{
    use BelongsToMerchant, LogsActivity;

    protected static $logFillable = true;
    protected static $logName = 'Merchant BFI';
    protected static $logOnlyDirty = true;

    protected $connection = "dpaisa";

    protected $guarded = [];

    protected $table = 'merchant_bfis';

    public function bfiUser(){
        return $this->belongsTo(BFIUser::class,'bfi_id', 'bfi_id');
    }

}

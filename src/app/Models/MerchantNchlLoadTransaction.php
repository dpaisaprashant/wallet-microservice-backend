<?php

namespace App\Models;

use App\Traits\BelongsToMerchant;
use App\Traits\MerchantTransactionable;
use Illuminate\Database\Eloquent\Model;

class MerchantNchlLoadTransaction extends Model
{

    use BelongsToMerchant, MerchantTransactionable;

    protected $connection = 'dpaisa';

    protected $guarded = [];

    protected $appends = ['nchl_merchant_id', 'app_id', 'app_name'];

    public function getNchlMerchantIdAttribute()
    {
        return config('nchl-credentials.load.merchant_id');
    }

    public function getAppIdAttribute()
    {
        return config('nchl-credentials.load.app_id');
    }

    public function getAppNameAttribute()
    {
        return config('nchl-credentials.load.app_name');
    }
}

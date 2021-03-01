<?php

namespace App\Models;

use App\Traits\MerchantTransactionable;
use App\Traits\MorphOneTransaction;
use Illuminate\Database\Eloquent\Model;

class MerchantTransaction extends Model
{
    use MorphOneTransaction, MerchantTransactionable;

    const STATUS_PROCESSING = 'PROCESSING';
    const STATUS_COMPLETE = 'COMPLETE';
    const STATUS_VERIFIED = 'VERIFIED';

    protected $connection = 'dpaisa';

    public function getAmountAttribute($amount)
    {
        return ($amount/100);
    }

}

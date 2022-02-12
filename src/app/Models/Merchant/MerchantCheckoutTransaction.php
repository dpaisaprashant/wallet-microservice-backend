<?php

namespace App\Models\Merchant;

use App\Traits\MerchantTransactionable;
use App\Traits\MorphOneTransaction;
use Illuminate\Database\Eloquent\Model;

class MerchantCheckoutTransaction extends Model
{
    use MorphOneTransaction;

    protected $connection = 'merchant-checkout';

    public function getAmountAttribute($amount)
    {
        return ($amount/100);
    }

}

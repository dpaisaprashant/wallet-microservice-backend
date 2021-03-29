<?php

namespace App\Models;

use App\Models\Merchant\MerchantEventTicket;
use App\Traits\BelongsToUser;
use App\Traits\MerchantTransactionable;
use App\Traits\MorphOneTransaction;
use Illuminate\Database\Eloquent\Model;

class UserMerchantEventTicketPayment extends Model
{
    use BelongsToUser, MorphOneTransaction, MerchantTransactionable;

    protected $guarded = [];

    protected $connection = 'dpaisa';

    public function merchantEventTicket()
    {
        return $this->belongsTo(MerchantEventTicket::class);
    }
}

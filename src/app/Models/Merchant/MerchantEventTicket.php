<?php

namespace App\Models\Merchant;

use App\Models\UserMerchantEventTicketPayment;
use Illuminate\Database\Eloquent\Model;

class MerchantEventTicket extends Model
{
    protected $connection = 'dpaisa';
    protected $guarded = [];

    public function getPriceAttribute($amount)
    {
        return ($amount/100);
    }

    public function merchantEvent()
    {
        return $this->belongsTo(MerchantEvent::class);
    }

    public function userMerchantEventTicketpayments()
    {
        return $this->hasMany(UserMerchantEventTicketPayment::class);
    }
}

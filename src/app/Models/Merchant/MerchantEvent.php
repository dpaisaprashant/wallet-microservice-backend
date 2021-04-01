<?php

namespace App\Models\Merchant;

use App\Models\EventCashback;
use App\Traits\BelongsToMerchant;
use Illuminate\Database\Eloquent\Model;

class MerchantEvent extends Model
{
    use BelongsToMerchant;

    CONST STATUS_PROCESSING = 'PROCESSING';
    CONST STATUS_ACCEPTED = 'ACCEPTED';
    CONST STATUS_REJECTED = 'REJECTED';

    protected $connection = 'dpaisa';
    protected $guarded = [];

    protected $casts = [
        'date' => 'date'
    ];

    public function merchantEventTickets()
    {
        return $this->hasMany(MerchantEventTicket::class);
    }

    public function eventCashback()
    {
        return $this->morphOne(EventCashback::class, 'eventCashbackable', 'event_type', 'event_id');
    }
}

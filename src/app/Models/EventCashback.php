<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventCashback extends Model
{
    protected $table = "event_cashbacks";
    protected $connection = "dpaisa";

    protected $guarded = [];

    public function eventCashbackable()
    {
        return $this->morphTo();
    }

}

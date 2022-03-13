<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use App\Traits\BelongsToUseThroughMicroservice;
use App\Traits\MorphOneCommission;
use App\Traits\MorphOneDispute;
use App\Traits\MorphOneTransaction;
use Illuminate\Database\Eloquent\Model;

class CashbackPull extends Model
{
    protected $connection = "dpaisa";
    protected $guarded = [];

    use BelongsToUser, BelongsToUseThroughMicroservice, MorphOneTransaction;

}

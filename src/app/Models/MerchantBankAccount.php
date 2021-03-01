<?php

namespace App\Models;

use App\Traits\BelongsToMerchant;
use Illuminate\Database\Eloquent\Model;

class MerchantBankAccount extends Model
{
    use BelongsToMerchant;

    protected $connection = 'dpaisa';

    protected $guarded = [];

}

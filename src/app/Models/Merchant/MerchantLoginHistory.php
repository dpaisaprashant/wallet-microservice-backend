<?php

namespace App\Models\Merchant;

use App\Traits\BelongsToMerchant;
use Illuminate\Database\Eloquent\Model;

class MerchantLoginHistory extends Model
{
    use BelongsToMerchant;
    protected $connection = 'merchant';
    protected $guarded = [];
}

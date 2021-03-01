<?php

namespace App\Models\Merchant;

use App\Traits\BelongsToMerchant;
use Illuminate\Database\Eloquent\Model;

class MerchantActivity extends Model
{
    use BelongsToMerchant;
    protected $connection = 'merchant';
    const UPDATED_AT = null;
    protected $fillable = ["title"];
    public $timestamps = ['created_at'];
}

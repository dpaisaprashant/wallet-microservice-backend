<?php

namespace App\Models;

use App\Filters\MerchantTransactionEvent\MerchantTransactionEventFilters;
use App\Traits\BelongsToMerchant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MerchantReseller extends Model
{
    use BelongsToMerchant;

    protected $connection = 'dpaisa';

    protected $guarded = [];

}

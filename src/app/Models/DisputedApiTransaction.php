<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisputedApiTransaction extends Model
{
    protected $table = 'disputed_api_transactions';

    protected $fillable = [
        'pre_transaction_id', 'transaction_id', 'ref_stan', 'api_response'
    ];


}

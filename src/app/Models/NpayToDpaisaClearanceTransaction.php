<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NpayToDpaisaClearanceTransaction extends Model
{
    protected $table = 'n_pay_to_dpaisa_clearance_transactions';
    protected $connection = 'dpaisa';

    protected $fillable = [
        'clearance_id',
        'gateway_ref_no',
        'card_no',
        'customer_transaction_id',
        'sct_id',
        'amount',
        'service_charge',
        'net_amount',
        'sct_npay_status',
        'cbs_status',
        'transaction_date',
    ];
}

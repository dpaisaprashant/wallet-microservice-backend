<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaypointToDpaisaClearanceTransaction extends Model
{
    protected $table = 'pay_point_to_dpaisa_clearance_transactions';
    protected $connection = 'dpaisa';

    protected $fillable = [
        'dealer_name',
        'institution',
        'company_name',
        'service_code',
        'registration_date',
        'account',
        'amount',
        'amount_transferred',
        'commission',
        'currency',
        'refStan',
        'status'
    ];


    public function getRevenueAttribute($revenue)
    {
        return $revenue / 100;
    }

    public function clearance()
    {
        return $this->belongsTo(Clearance::class);
    }
}

<?php

namespace App\Models\Khalti;

use Illuminate\Database\Eloquent\Model;

class Khalti_service extends Model
{
    protected $connection = 'dpaisa';
    protected $fillable = [
        'label',
        'image',
        'service',
        'step',
        'forms',
        'paymentDetail',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BackendUserMerchant extends Model
{
    protected $table='backend_user_merchants';

    protected $fillable = [
        'user_id', 'merchant_id', 'before_properties', 'after_properties'
    ];

}

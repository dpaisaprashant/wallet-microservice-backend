<?php

namespace App\Models\appNotification;

use Illuminate\Database\Eloquent\Model;

class AppNotification extends Model
{
    protected $connection = 'dpaisa';
    protected $fillable = [
        'token',
        'message',
    ];
}

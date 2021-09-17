<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BackendUserWalletUser extends Model
{
    protected $table='backend_user_wallet_users';

    protected $fillable = [
        'backend_user_id', 'wallet_user_id', 'before_properties', 'after_properties'
    ];
}

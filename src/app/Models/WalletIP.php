<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class WalletIP extends Model
{
    protected $connection='dpaisa';
    protected $table='blocked_ips';

    protected $fillable=[
            'ip', 
            'description',
            'blocked_at', 
            'block_duration',
            'status'
    ];
    

}

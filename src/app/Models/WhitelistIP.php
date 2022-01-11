<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class WhitelistIP extends Model
{
    protected $connection='dpaisa';
    protected $table='whitelist_ips';

    protected $fillable=[
            'ip', 
            'title',
            'status',            
    ];
    

}

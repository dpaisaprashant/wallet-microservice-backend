<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{

    protected $connection = 'dpaisa';

    protected $fillable = [
        'title', 'description', 'image'
    ];
}

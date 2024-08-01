<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemRepost extends Model
{

    protected $connection = "dpaisa";
    protected $table = "system_reposts";
    protected $guarded = [];

}

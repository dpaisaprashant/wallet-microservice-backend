<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class UserReferralLimit extends Model
{
    use BelongsToUser;

    protected $connection = 'dpaisa';
    protected $guarded = [];
}

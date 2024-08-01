<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class UserBonus extends Model
{
    use BelongsToUser;

    protected $guarded = [];

    protected $connection = 'dpaisa';
    protected $table = 'user_bonuses';

}

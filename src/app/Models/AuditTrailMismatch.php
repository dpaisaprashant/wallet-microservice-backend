<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class AuditTrailMismatch extends Model
{
    //
    use BelongsToUser;

    protected $connection = 'clearance';
    protected $table = 'audit_trial_mismatch';

//    public function user

}

<?php

namespace App\Models;

use App\Traits\StoreSetting;
use App\Traits\UploadImage;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class AgentSetting extends Model
{
    use StoreSetting, UploadImage, LogsActivity;

    protected $connection = 'dpaisa';
    protected $table = 'settings';
    protected $fillable = ["option", "value"];
}

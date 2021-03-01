<?php

namespace App\Models;

use App\Traits\StoreSetting;
use App\Traits\UploadImage;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class NchlSetting extends Model
{
    use StoreSetting, UploadImage, LogsActivity;

    protected $connection = 'nchl';
    protected $table = 'settings';
    protected $fillable = ["option", "value"];
}

<?php

namespace App\Models;

use App\Traits\StoreSetting;
use App\Traits\UploadImage;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class NpsSetting extends Model
{
    use StoreSetting, UploadImage, LogsActivity;

    protected $connection = 'nps';
    protected $table = 'settings';
    protected $fillable = ["option", "value"];
}

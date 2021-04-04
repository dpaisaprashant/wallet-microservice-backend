<?php

namespace App\Models;

use App\Traits\StoreSetting;
use App\Traits\UploadImage;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class NpaySetting extends Model
{
    use StoreSetting, UploadImage, LogsActivity;

    protected $connection = 'npay';
    protected $table = 'settings';
    protected $fillable = ["option", "value"];
}

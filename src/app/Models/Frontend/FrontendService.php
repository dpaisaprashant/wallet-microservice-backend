<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class FrontendService extends Model
{
    protected $connection = 'dpaisa';

    protected $fillable = [
        'title',
        'icon',
        'image',
        'description',
    ];
}

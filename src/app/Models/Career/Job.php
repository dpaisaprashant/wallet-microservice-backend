<?php

namespace App\Models\Career;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $connection = 'dpaisa';
    protected $fillable = [
        'title',
        'opening',
        'domain',
        'location',
        'salary',
        'description',
        'specification',
      ];
}

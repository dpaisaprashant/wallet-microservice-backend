<?php

namespace App\Models\Feedback;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $connection = 'dpaisa';
    protected $table = 'feedbacks'; 
    protected $fillable = [
        'services',
        'description',
        'image',
      ];
}

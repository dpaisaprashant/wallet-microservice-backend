<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $connection = 'dpaisa';
  
    protected $fillable = [ 'name', ];
    
    public function posts(): BelongsTo
{
    return $this->belongsTo(Post::class, 'type');
}
}


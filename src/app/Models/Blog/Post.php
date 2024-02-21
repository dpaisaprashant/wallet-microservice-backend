<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $connection = 'dpaisa';
    protected $fillable = [
        'title',
        'description',
        'author',
        'image',
        'tag',
        'type',
        'status',
      ];

    // one to one relation
    public function types(): HasOne
    {
        return $this->hasOne(Type::class, 'id', 'type');       
    }

    // one to many relation
    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class, 'id', 'tag');
    }
}

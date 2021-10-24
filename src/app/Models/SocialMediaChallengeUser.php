<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SocialMediaChallengeUser extends Model
{
    protected $table = 'user_social_challenges';
    protected $connection = 'dpaisa';

    protected $fillable = [
        'social_challenge_id',
        'user_id',
        'link',
        'embed_link',
        'caption',
        'challenge_status',
        'special1',
        'special2',
        'special3',
        'special4',
    ];

//    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
//    {
//        return (new SocialMediaChallengeFilters($request))->add($filters)->filter($builder);
//    }

}

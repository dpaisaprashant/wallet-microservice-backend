<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SocialMediaChallengeWinner extends Model
{
    protected $table = 'social_challenges_winners';
    protected $connection = 'dpaisa';

    protected $fillable = [
        'user_id',
        'social_challenges_id',
        'won_at',
        'description',
    ];

//    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
//    {
//        return (new SocialMediaChallengeFilters($request))->add($filters)->filter($builder);
//    }

}

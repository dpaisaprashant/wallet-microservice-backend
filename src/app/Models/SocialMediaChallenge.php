<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SocialMediaChallenge extends Model
{
    protected $table = 'social_challenges';
    protected $connection = 'dpaisa';

    protected $fillable = [
        'title',
        'code',
        'type',
        'description',
        'terms_and_conditions',
        'status',
        'attempts_per_user',
        'expired_at',
        'special1',
        'special2',
        'special3',
        'special4'
    ];

//    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
//    {
//        return (new SocialMediaChallengeFilters($request))->add($filters)->filter($builder);
//    }

}

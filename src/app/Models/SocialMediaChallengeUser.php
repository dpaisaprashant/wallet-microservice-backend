<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Traits\BelongsToUser;

class SocialMediaChallengeUser extends Model
{
    use BelongsToUser;

    protected $table = 'user_social_challenges';
    protected $connection = 'dpaisa';

    protected $fillable = [
        'social_challenge_id',
        'user_id',
        'link',
        'embed_link',
        'facebook_link',
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

    public function socialMediaChallenge()
    {
        return $this->belongsTo(SocialMediaChallenge::class, 'social_challenge_id');
    }


}

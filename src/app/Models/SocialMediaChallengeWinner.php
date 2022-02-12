<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Traits\BelongsToUser;

class SocialMediaChallengeWinner extends Model
{
    use belongsToUser;

    protected $table = 'social_challenges_winners';
    protected $connection = 'dpaisa';

    protected $fillable = [
        'user_id',
        'social_challenge_id',
        'won_at',
        'description',
    ];

    public function socialMediaChallenge()
    {
        return $this->belongsTo(SocialMediaChallenge::class, 'social_challenge_id');
    }

//    public function challengeWinner()
//    {
//        return $this->belongsTo(SocialMediaChallengeUser::class, 'user_id','user_id');
//    }

}

<?php

namespace App\Models;


use App\Filters\SwipeVotingParticipant\SwipeVotingParticipantFilters;
use App\Filters\SwipeVotingVote\SwipeVotingVoteFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class SwipeVotingVote extends Model
{
    protected $connection='swipe_voting';
    protected $table='votes';

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new SwipeVotingVoteFilters($request))->add($filters)->filter($builder);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'voted_by','id');
    }
    public function participant()
    {
        return $this->belongsTo(SwipeVotingParticipant::class, 'participant_code','participant_code');
    }
}

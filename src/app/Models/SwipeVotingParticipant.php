<?php

namespace App\Models;


use App\Filters\SwipeVotingParticipant\SwipeVotingParticipantFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class SwipeVotingParticipant extends Model
{
    protected $connection='swipe_voting';
    protected $table='participants';

    protected $fillable=[
            'status'
    ];

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new SwipeVotingParticipantFilters($request))->add($filters)->filter($builder);
    }
}

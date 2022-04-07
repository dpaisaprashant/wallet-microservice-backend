<?php

namespace App\Models;


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


}

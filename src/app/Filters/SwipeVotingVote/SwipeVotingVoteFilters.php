<?php

namespace App\Filters\SwipeVotingVote;

use App\Filters\FiltersAbstract;

class SwipeVotingVoteFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'participant_name' => ParticipantNameFilter::class,
        'participant_mobile_no' => ParticipantMobileNoFilter::class,
        'event_code' => EventCodeFilter::class,
    ];


    /**
     * Mappings for course filter values.
     *
     * @return array
     */
    public static function mapping()
    {
        $map = [
            'sort' => [
                'date' => 'created_at',
            ]
        ];

        return $map;
    }
}

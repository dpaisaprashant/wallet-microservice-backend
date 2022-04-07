<?php

namespace App\Filters\SwipeVotingParticipant;

use App\Filters\FiltersAbstract;

class SwipeVotingParticipantFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
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

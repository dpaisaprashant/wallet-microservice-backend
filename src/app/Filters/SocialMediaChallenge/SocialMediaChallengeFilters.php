<?php
namespace App\Filters\SocialMediaChallenge;

use App\Filters\FiltersAbstract;

class SocialMediaChallengeFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'title' => TitleFilter::class,
        'code' => CodeFilter::class,
        'type' => TypeFilter::class,
        'status' => StatusFilter::class,
//        'from' => FromDateFilter::class,
//        'to' => ToDateFilter::class,
    ];


    /**
     * Mappings for course filter values.
     *
     * @return array
     */
    public static function mapping() {
        $map = [

        ];

        return  $map;
    }
}

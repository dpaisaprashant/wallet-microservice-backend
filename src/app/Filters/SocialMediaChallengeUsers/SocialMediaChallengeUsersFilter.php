<?php
namespace App\Filters\SocialMediaChallengeUsers;

use App\Filters\FiltersAbstract;

class SocialMediaChallengeUsersFilter extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'user_name' => UserFilter::class,
        'user_mobile' => MobileFilter::class,
        'caption' => CaptionFilter::class,
        'challenge_status' => StatusFilter::class,
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

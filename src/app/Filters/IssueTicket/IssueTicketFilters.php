<?php
namespace App\Filters\IssueTicket;

use App\Filters\FiltersAbstract;

class IssueTicketFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'from' => FromDateFilter::class,
        'to' => ToDateFilter::class,
        'user_name' => UserFilter::class,
        'phone_number' => PhoneNumberFilter::class,
        'issued_by' => TicketCreatedByFilter::class,
        'solved_by' => TicketSolvedByFilter::class,
        'issue_description' => IssueDescriptionFilter::class,
        'status' => StatusFilter::class,
    ];


    /**
     * Mappings for course filter values.
     *
     * @return array
     */
    public static function mapping() {
        $map = [
            'sort' => [
                'date' => 'created_at',
            ]
        ];

        return  $map;
    }
}

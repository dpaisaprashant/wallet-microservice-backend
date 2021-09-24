<?php

namespace App\Models;

use App\Filters\IssueTicket\IssueTicketFilters;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class IssueTicket extends Model
{
    use BelongsToUser;

    protected $table = 'issue_tickets';

    protected $fillable = [
        'user_id',
        'issued_by',
        'solved_by',
        'issue_description',
        'solution_description',
        'status',
        'solved_at'
    ];

    public function adminCreator()
    {
        return $this->belongsTo(Admin::class, 'issued_by');
    }

    public function adminSolver()
    {
        return $this->belongsTo(Admin::class, 'solved_by');
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new IssueTicketFilters($request))->add($filters)->filter($builder);
    }

//    public function users()
//    {
//        return $this->setConnection('dpaisa')->belongsTo(User::class, 'user_id');
//    }
}

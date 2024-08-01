<?php


namespace App\Wallet\IssueTicket\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Traits\CollectionPaginate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\IssueTicket;
use Illuminate\Support\Facades\View;
use App\Traits\BelongsToUser;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class IssueTicketController extends Controller
{
    public function view(Request $request)
    {
        $status = IssueTicket::groupBy('status')->pluck('status')->toArray();

        View::share('status', $status);

//        dd($request->all());
        $issueTickets = IssueTicket::with('adminCreator', 'adminSolver')->filter($request)->paginate(20);

        return view('IssueTicket::view-issue-ticket', compact('issueTickets'));
    }

    public function create(Request $request)
    {
        $users = User::all();
        return view('IssueTicket::create-issue-ticket', compact('users'));
    }

    public function store(Request $request)
    {
        if ($request->status == 'SOLVED') {
            $request->request->add(['solved_at' => Carbon::now()->toDateTimeString(),
                'solved_by' => auth()->user()->id]);
        }

        IssueTicket::create([
            'user_id' => $request->get('user_id'),
            'issued_by' => $request->get('issued_by'),
            'solved_by' => $request->get('solved_by'),
            'issue_description' => $request->get('issue_description'),
            'solution_description' => $request->get('solution_description'),
            'status' => $request->get('status'),
            'solved_at' => $request->get('solved_at'),
            'created_at' => $request->get('created_at')
        ]);

        return redirect()->route('issue.ticket.view')->with('success', 'Ticket added to list');
    }

    public function delete($id)
    {
        $issueTicket = IssueTicket::findOrFail($id);

        $issueTicket->delete();

        return redirect()->route('issue.ticket.view')->with('success', 'Ticket deleted successfully');
    }

    public function edit($id)
    {
        $ticket = IssueTicket::findOrFail($id);

        $users = User::all();

        return view('IssueTicket::edit-issue-ticket', compact('ticket', 'users'));
    }

    public function update(Request $request, $id)
    {

        $issueTicket = IssueTicket::findOrFail($id);

        if (!isset($issueTicket->solved_at) && !isset($issueTicket->solved_by)) {
            if ($request->status == 'SOLVED') {
                $request->request->add(['solved_at' => Carbon::now()->toDateTimeString(),
                    'solved_by' => auth()->user()->id]);
            }
        }

        if (isset($issueTicket->solved_at) && isset($issueTicket->solved_by)) {
            if ($request->status == 'PENDING') {
                $request->request->add(['solved_at' => null, 'solved_by' => null]);
            }
        }

        $issueTicket = IssueTicket::where('id', $id)->update([
            'user_id' => $request->get('user_id'),
            'issued_by' => $request->get('issued_by'),
            'solved_by' => $request->get('solved_by'),
            'issue_description' => $request->get('issue_description'),
            'solution_description' => $request->get('solution_description'),
            'status' => $request->get('status'),
            'solved_at' => $request->get('solved_at'),
        ]);

        return redirect()->route('issue.ticket.view')->with('success', 'Ticket updated successfully');
    }
}

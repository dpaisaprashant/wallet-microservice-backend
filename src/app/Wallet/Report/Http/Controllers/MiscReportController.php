<?php


namespace App\Wallet\Report\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\DeviceInfo;
use App\Models\SwipeVotingParticipant;
use App\Models\SwipeVotingParticipants;
use App\Traits\CollectionPaginate;
use App\Wallet\Report\Repositories\MiscReportRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class MiscReportController extends Controller
{
    use CollectionPaginate;

    public function luckyWinnerReport(Request $request)
    {
        $repository = new MiscReportRepository($request);

        $luckyWinners = $repository->luckyWinner();

        return view('WalletReport::luckyWinner.lucky-winner-report')->with(compact('luckyWinners'));
    }

    public function ticketSalesReport(Request $request)
    {
        $repository = new MiscReportRepository($request);

        $ticketSales = $repository->ticketSale();

        return view('WalletReport::ticketSale.ticket-sale-report')->with(compact('ticketSales'));
    }

    public function votingReport(Request $request)
    {
        if (!empty($request->all())) {
            $repository = new MiscReportRepository($request);
            $eventCode = $request->event_code;
            $participants = $repository->campaignVoting($eventCode);
            View::share('participants', $participants);
        }

        $events = DB::connection('swipe_voting')->select("SELECT * from events WHERE event_code != 'ITOLYMPIAD2022PERSON' AND event_code != 'ITOLYMPIAD2022SCHOOL'");
        View::share('events', $events);

        $baseUrl = config('dpaisa-api-url.swipe-voting-participant-image-url');
        View::share('baseUrl', $baseUrl);

        return view('WalletReport::voting.voting-report');
    }

    public function disqualifyParticipant($id)
    {
        $participant = SwipeVotingParticipant::where('id', $id);

        if ($participant->first()->status == 1) {
            $participant->update(['status' => 0]);
        } else {
            $participant->update(['status' => 1]);
        }

        $events = DB::connection('swipe_voting')->select("SELECT * from events");

        View::share('events', $events);

        return redirect()->back()->with('success', 'Participant Status Changed Successfully.');
//        return view('WalletReport::voting.voting-report');
    }

    public function voterReport(Request $request)
    {
        if (!empty($request->all())) {
            $repository = new MiscReportRepository($request);
            $eventCode = $request->event_code;
            $votes = $repository->campaignVotes($eventCode);
            View::share('votes', $votes);
        }

        $repository = new MiscReportRepository($request);
        $eventCode = $request->event_code;

        $events = DB::connection('swipe_voting')->select("SELECT * from events WHERE event_code != 'ITOLYMPIAD2022PERSON' AND event_code != 'ITOLYMPIAD2022SCHOOL'");
       View::share('events', $events);

        return view('WalletReport::voting.voter-report');
    }

    public function deviceInfo(Request $request)
    {
        $deviceInfos = DeviceInfo::filter($request)->paginate(10);
        View::share('deviceInfos', $deviceInfos);

        return view('WalletReport::deviceInfo.device-info-view');
    }
}

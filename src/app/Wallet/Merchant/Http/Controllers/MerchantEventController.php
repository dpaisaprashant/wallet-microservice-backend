<?php


namespace App\Wallet\Merchant\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\EventCashback;
use App\Models\Merchant\MerchantEvent;
use Illuminate\Http\Request;

class MerchantEventController extends Controller
{
    public function eventLists()
    {
        $events = MerchantEvent::with('merchantEventTickets', 'merchant')
            ->latest()
            ->paginate(25);

        return view('Merchant::merchantEvent.list')->with(compact('events'));
    }

    public function pendingEventList()
    {
        $events = MerchantEvent::with('merchantEventTickets', 'merchant')
            ->where('status', MerchantEvent::STATUS_PROCESSING)
            ->latest()
            ->paginate(25);

        return view('Merchant::merchantEvent.pendingList')->with(compact('events'));
    }

    public function updateEvent($id, Request $request)
    {
        $event = MerchantEvent::with('eventCashback')->where('id', $id)->first();

        $event->load(['merchantEventTickets', 'merchant']);

        if ($request->isMethod('POST')) {
            $event->update(["status" => $request->status]);

            EventCashback::updateOrCreate(
                ['event_id' => $event->id, 'event_type' => MerchantEvent::class],
                [
                    'type' => 'CASHBACK',
                    'cashback_type' => $request->type,
                    'cashback_value' => $request->value
                ]
            );

            return redirect()->back()->with('success', "Event updated successfully");
        }

        return view('Merchant::merchantEvent.eventDetail')->with(compact('event'));
    }
}

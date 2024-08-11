<?php

namespace App\Http\Controllers;

use App\Models\SparrowSMS;
use Illuminate\Http\Request;

class SparrowSMSController extends Controller
{
    public function index(Request $request)
    {
        $query = SparrowSMS::filter($request);

        // Apply sorting if specified
        if (!empty($request->sort)) {
            if ($request->sort === 'date') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sort === 'rate') {
                $query->orderBy('rate', 'desc');
            }
        } else {
            // Default sorting by latest date
            $query->latest();
        }

        $messages = $query->paginate(50);

        // Mask OTP codes and PNR numbers in descriptions
        foreach ($messages as $message) {
            $message->description = $this->maskSensitiveData($message->description);
        }

        return view('admin.sparrow.view', compact('messages'));
    }

    private function maskSensitiveData($description)
    {
        // Regex to find OTP codes (assuming OTP is a 5 or 6 digit number)
        $description = preg_replace('/\b\d{5,6}\b/', '*****', $description);

        // Regex to find PNR numbers (assuming PNR is a 6 character alphanumeric string)
        $description = preg_replace('/\b[A-Z0-9]{6}\b/', '******', $description);

        return $description;
    }

    public function detail(Request $request)
    {
        $smsCount = SparrowSMS::count();

        return view('admin.sparrow.detail', compact('smsCount'));
    }
}

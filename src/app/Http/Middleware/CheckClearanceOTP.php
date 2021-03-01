<?php

namespace App\Http\Middleware;

use Closure;

class CheckClearanceOTP
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param $type
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {

        $hasOTP = $request->session()->pull('hasClearanceOTP', false);

        if ($hasOTP) {
            return $next($request);
        }

        if ($type == 'paypoint')
        {
            return redirect()->route('clearance.paypoint')->with('error', 'Enter OTP to view clearance');
        }else {
            return redirect()->route('clearance.npay')->with('error', 'Enter OTP to view clearance');
        }
    }
}

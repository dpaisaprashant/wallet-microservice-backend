<?php

namespace App\Http\Controllers;

use App\Models\appNotification\AppNotification;
use Illuminate\Http\Request;

class AppNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.appNotification.notification');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'message' => 'required',
        ]);
        $notifications = new AppNotification;
        $notifications->token = $request->token;
        $notifications->message = $request->message;

        $notifications->save();
        return redirect('admin/appNotification/notification')
        ->with('success', 'Notification created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AppNotification  $appNotification
     * @return \Illuminate\Http\Response
     */
    public function show(AppNotification $appNotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AppNotification  $appNotification
     * @return \Illuminate\Http\Response
     */
    public function edit(AppNotification $appNotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AppNotification  $appNotification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppNotification $appNotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AppNotification  $appNotification
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppNotification $appNotification)
    {
        //
    }
}

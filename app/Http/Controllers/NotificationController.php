<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }

    public function index()
    {
        $notifications = auth()->user()->notifications;
        return view('notifications.index', compact('notifications'));
    }
}

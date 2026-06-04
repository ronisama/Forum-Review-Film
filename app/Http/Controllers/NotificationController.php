<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        Notification::where(
            'user_id',
            Auth::id()
        )
            ->update([
                'is_read' => true
            ]);

        $notifications = Notification::with([
            'pengirim',
            'thread'
        ])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view(
            'pages.Notifications',
            compact('notifications')
        );
    }
}

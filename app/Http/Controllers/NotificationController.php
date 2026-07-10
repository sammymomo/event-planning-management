<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(20);

        Notification::where('user_id', Auth::id())
            ->where('read_status', false)
            ->update(['read_status' => true]);

        return view('notifications.index', compact('notifications'));
    }
}

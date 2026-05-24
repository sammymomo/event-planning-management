<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Enums\EventStatus;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $events = $user->organizedEvents()
            ->withCount(['registrations', 'volunteerTasks'])
            ->orderByDesc('date')
            ->get();

        $stats = [
            'total'    => $events->count(),
            'upcoming' => $events->where('date', '>=', today())->where('status', EventStatus::Approved)->count(),
            'pending'  => $events->where('status', EventStatus::Pending)->count(),
            'attendees' => $events->sum('registrations_count'),
        ];

        return view('organizer.dashboard', compact('events', 'stats'));
    }
}

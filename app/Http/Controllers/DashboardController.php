<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return match($user->role->value) {
            'organizer' => redirect()->route('organizer.dashboard'),
            'admin'     => redirect()->route('admin.events.index'),
            'volunteer' => redirect()->route('volunteer.tasks.index'),
            'sponsor'   => redirect()->route('sponsor.dashboard'),
            default     => view('member.dashboard', [
                'upcomingRegistrations' => $user->registrations()
                    ->with('event')
                    ->whereHas('event', fn($q) => $q->where('date', '>=', now()))
                    ->where('status', 'confirmed')
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get(),
            ]),
        };
    }
}

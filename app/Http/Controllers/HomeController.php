<?php

namespace App\Http\Controllers;

use App\Enums\EventStatus;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\User;
use App\Models\VolunteerAssignment;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Event::with('organizer')
            ->where('status', EventStatus::Approved)
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->take(3)
            ->get();

        $stats = [
            'events'      => Event::where('status', EventStatus::Approved)->count(),
            'participants' => EventRegistration::distinct('user_id')->count('user_id'),
            'volunteers'  => VolunteerAssignment::distinct('user_id')->count('user_id'),
            'members'     => User::count(),
        ];

        return view('home', compact('featured', 'stats'));
    }
}

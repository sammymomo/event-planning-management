<?php

namespace App\Http\Controllers;

use App\Enums\EventStatus;
use App\Models\Event;

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

        return view('home', compact('featured'));
    }
}

<?php

namespace App\Http\Controllers\Sponsor;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorshipController extends Controller
{
    public function create()
    {
        $events = Event::where('status', 'approved')
            ->orderBy('date')
            ->get();

        return view('sponsor.sponsorships.create', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id'      => ['required', 'exists:events,id'],
            'amount'        => ['required', 'numeric', 'min:1'],
            'resource_type' => ['required', 'string', 'max:100'],
        ]);

        $event = Event::findOrFail($request->event_id);

        if ($event->status->value !== 'approved') {
            return back()->with('error', 'You can only sponsor approved events.');
        }

        Sponsorship::create([
            'sponsor_id'    => Auth::id(),
            'event_id'      => $request->event_id,
            'amount'        => $request->amount,
            'resource_type' => $request->resource_type,
            'acknowledged'  => false,
        ]);

        return redirect()->route('sponsor.dashboard')
            ->with('success', 'Sponsorship submitted successfully!');
    }

    public function acknowledgment(Sponsorship $sponsorship)
    {
        abort_if($sponsorship->sponsor_id !== Auth::id(), 403);
        abort_if(!$sponsorship->acknowledged, 404);

        $sponsorship->load('event');

        return view('sponsor.sponsorships.acknowledgment', compact('sponsorship'));
    }

    public function report(Sponsorship $sponsorship)
    {
        abort_if($sponsorship->sponsor_id !== Auth::id(), 403);

        $sponsorship->load('event.registrations', 'event.feedback');

        $attendeeCount  = $sponsorship->event->registrations->where('status', 'attended')->count();
        $avgRating      = round($sponsorship->event->feedback->avg('rating') ?? 0, 1);
        $totalFeedback  = $sponsorship->event->feedback->count();

        return view('sponsor.sponsorships.report', compact(
            'sponsorship', 'attendeeCount', 'avgRating', 'totalFeedback'
        ));
    }
}

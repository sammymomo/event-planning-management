<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationConfirmed;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    public function store(Event $event)
    {
        if ($event->status->value !== 'approved') {
            return back()->with('error', 'This event is not open for registration.');
        }

        $already = EventRegistration::where('user_id', Auth::id())
            ->where('event_id', $event->id)
            ->whereNot('status', 'canceled')
            ->exists();

        if ($already) {
            return back()->with('error', 'You are already registered for this event.');
        }

        EventRegistration::create([
            'user_id'  => Auth::id(),
            'event_id' => $event->id,
            'status'   => 'confirmed',
        ]);

        NotificationService::send(
            Auth::user(),
            "You're registered for \"{$event->title}\" on {$event->date->format('M j, Y')}."
        );

        Mail::to(Auth::user()->email)->send(new RegistrationConfirmed(Auth::user(), $event));

        return back()->with('success', 'You are registered! See you at ' . $event->title . '.');
    }

    public function destroy(Event $event)
    {
        EventRegistration::where('user_id', Auth::id())
            ->where('event_id', $event->id)
            ->where('status', 'confirmed')
            ->update(['status' => 'canceled']);

        return back()->with('success', 'Your registration has been canceled.');
    }

    public function index()
    {
        $registrations = EventRegistration::with('event')
            ->where('user_id', Auth::id())
            ->orderByDesc('registered_at')
            ->paginate(15);

        return view('member.registrations', compact('registrations'));
    }
}

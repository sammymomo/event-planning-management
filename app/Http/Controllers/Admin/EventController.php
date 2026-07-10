<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Enums\EventStatus;
use App\Models\Event;
use App\Services\AuditLogger;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $pending = Event::with('organizer')
            ->where('status', EventStatus::Pending)
            ->orderBy('created_at')
            ->get();

        $recent = Event::with('organizer')
            ->whereIn('status', [EventStatus::Approved, EventStatus::Canceled])
            ->orderByDesc('updated_at')
            ->take(10)
            ->get();

        return view('admin.events.index', compact('pending', 'recent'));
    }

    public function approve(Event $event)
    {
        $event->update(['status' => EventStatus::Approved]);
        AuditLogger::log(Auth::user(), "approved event #{$event->id}: {$event->title}");
        NotificationService::send(
            $event->organizer,
            "Your event \"{$event->title}\" has been approved and is now live."
        );

        return back()->with('success', "Event \"{$event->title}\" has been approved.");
    }

    public function reject(Request $request, Event $event)
    {
        $event->update(['status' => EventStatus::Canceled]);
        AuditLogger::log(Auth::user(), "rejected event #{$event->id}: {$event->title}");
        NotificationService::send(
            $event->organizer,
            "Your event \"{$event->title}\" was not approved. Please contact an admin for details."
        );

        return back()->with('success', "Event \"{$event->title}\" has been rejected.");
    }
}

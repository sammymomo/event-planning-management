<?php

namespace App\Http\Controllers;

use App\Enums\EventStatus;
use App\Models\Event;
use Illuminate\Http\Request;

class EventCatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with('organizer')
            ->where('status', EventStatus::Approved)
            ->where('date', '>=', now()->toDateString());

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($location = $request->input('location')) {
            $query->where('location', 'like', "%{$location}%");
        }

        if ($from = $request->input('from')) {
            $query->where('date', '>=', $from);
        }

        if ($to = $request->input('to')) {
            $query->where('date', '<=', $to);
        }

        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }

        $events = $query->orderBy('date')->paginate(9)->withQueryString();
        $categories = Event::CATEGORIES;

        return view('events.catalog', compact('events', 'categories'));
    }

    public function show(Event $event)
    {
        abort_if($event->status !== EventStatus::Approved, 404);

        $event->load(['organizer', 'volunteerTasks', 'feedback.user', 'registrations']);

        $avgRating = $event->feedback->avg('rating');
        $taskCount = $event->volunteerTasks->count();

        return view('events.show', compact('event', 'avgRating', 'taskCount'));
    }
}

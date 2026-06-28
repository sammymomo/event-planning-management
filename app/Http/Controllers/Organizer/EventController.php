<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\VolunteerTask;
use App\Services\AuditLogger;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    use AuthorizesRequests;

    public function create()
    {
        return view('organizer.events.create', ['categories' => Event::CATEGORIES]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date'        => 'required|date|after_or_equal:today',
            'location'    => 'required|string|max:255',
            'category'    => 'nullable|string|max:100',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event = Auth::user()->organizedEvents()->create($validated);

        AuditLogger::log(Auth::user(), "created event #{$event->id}: {$event->title}");

        return redirect()->route('organizer.events.edit', $event)
            ->with('success', 'Event created! Add volunteer tasks below, then submit for approval.');
    }

    public function edit(Event $event)
    {
        $this->authorize('update', $event);
        $event->load('volunteerTasks');
        return view('organizer.events.edit', ['event' => $event, 'categories' => Event::CATEGORIES]);
    }

    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
            'category'    => 'nullable|string|max:100',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($validated);

        AuditLogger::log(Auth::user(), "updated event #{$event->id}: {$event->title}");

        return back()->with('success', 'Event updated successfully.');
    }

    public function storeTask(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validate([
            'task_name'       => 'required|string|max:255',
            'description'     => 'nullable|string|max:500',
            'slots_available' => 'required|integer|min:1|max:999',
        ]);

        $event->volunteerTasks()->create($validated);

        return back()->with('success', 'Volunteer task added.');
    }

    public function destroyTask(Event $event, VolunteerTask $task)
    {
        $this->authorize('update', $event);
        $task->delete();
        return back()->with('success', 'Task removed.');
    }
}

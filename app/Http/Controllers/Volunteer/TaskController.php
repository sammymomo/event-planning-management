<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\VolunteerAssignment;
use App\Models\VolunteerTask;
use App\Services\AuditLogger;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = VolunteerTask::with(['event', 'assignments'])
            ->whereHas('event', fn($q) => $q->where('status', 'approved'))
            ->get()
            ->map(function ($task) {
                $task->slots_remaining = $task->slots_available - $task->assignments->count();
                $task->signed_up = $task->assignments->where('user_id', Auth::id())->isNotEmpty();
                return $task;
            });

        return view('volunteer.tasks', compact('tasks'));
    }

    public function signup(VolunteerTask $task)
    {
        if ($task->event->status->value !== 'approved') {
            return back()->with('error', 'This event is not active.');
        }

        $already = VolunteerAssignment::where('user_id', Auth::id())
            ->where('task_id', $task->id)
            ->exists();

        if ($already) {
            return back()->with('error', 'You are already signed up for this task.');
        }

        $remaining = $task->slots_available - $task->assignments()->count();
        if ($remaining <= 0) {
            return back()->with('error', 'No slots remaining for this task.');
        }

        VolunteerAssignment::create([
            'user_id' => Auth::id(),
            'task_id' => $task->id,
        ]);

        AuditLogger::log(Auth::user(), "signed up for volunteer task \"{$task->task_name}\" on event #{$task->event->id}: {$task->event->title}");
        NotificationService::send(
            Auth::user(),
            "You signed up to volunteer as \"{$task->task_name}\" for \"{$task->event->title}\"."
        );

        return back()->with('success', 'You have signed up for: ' . $task->task_name);
    }

    public function leave(VolunteerTask $task)
    {
        VolunteerAssignment::where('user_id', Auth::id())
            ->where('task_id', $task->id)
            ->delete();

        AuditLogger::log(Auth::user(), "left volunteer task \"{$task->task_name}\" on event #{$task->event->id}");

        return back()->with('success', 'You have left the task.');
    }
}

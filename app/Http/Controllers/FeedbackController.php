<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FeedbackController extends Controller
{
    use AuthorizesRequests;

    public function create(Event $event)
    {
        $this->authorize('create', [Feedback::class, $event]);

        $already = Feedback::where('user_id', Auth::id())
            ->where('event_id', $event->id)
            ->exists();

        if ($already) {
            return redirect()->route('events.show', $event)
                ->with('error', 'You have already submitted feedback for this event.');
        }

        return view('member.feedback.create', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $this->authorize('create', [Feedback::class, $event]);

        $request->validate([
            'rating'   => ['required', 'integer', 'min:1', 'max:5'],
            'comments' => ['nullable', 'string', 'max:1000'],
        ]);

        Feedback::create([
            'user_id'  => Auth::id(),
            'event_id' => $event->id,
            'rating'   => $request->rating,
            'comments' => $request->comments,
        ]);

        return redirect()->route('events.show', $event)
            ->with('success', 'Thank you for your feedback!');
    }
}

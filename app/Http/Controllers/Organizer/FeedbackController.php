<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FeedbackController extends Controller
{
    use AuthorizesRequests;

    public function index(Event $event)
    {
        $this->authorize('update', $event);

        $feedback = $event->feedback()->with('user')->orderByDesc('submitted_at')->get();
        $avgRating = $feedback->avg('rating');

        return view('organizer.events.feedback', compact('event', 'feedback', 'avgRating'));
    }
}

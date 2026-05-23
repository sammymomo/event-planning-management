<?php

namespace App\Policies;

use App\Models\Feedback;
use App\Models\User;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Enums\RegistrationStatus;

class FeedbackPolicy
{
    public function create(User $user, Event $event): bool
    {
        return EventRegistration::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->where('status', RegistrationStatus::Attended)
            ->exists();
    }
}

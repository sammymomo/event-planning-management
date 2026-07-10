<?php

namespace App\Console\Commands;

use App\Mail\VolunteerTaskReminder;
use App\Models\VolunteerAssignment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEventReminders extends Command
{
    protected $signature = 'reminders:send';

    protected $description = 'Send email reminders to volunteers whose event is tomorrow';

    public function handle(): void
    {
        $tomorrow = now()->addDay()->toDateString();

        $assignments = VolunteerAssignment::with(['user', 'task.event'])
            ->whereHas('task.event', fn ($q) => $q->where('date', $tomorrow)->where('status', 'approved'))
            ->get();

        if ($assignments->isEmpty()) {
            $this->info('No volunteer reminders to send today.');
            return;
        }

        foreach ($assignments as $assignment) {
            Mail::to($assignment->user->email)
                ->send(new VolunteerTaskReminder($assignment->user, $assignment->task));
        }

        $this->info("Sent {$assignments->count()} volunteer reminder(s).");
    }
}

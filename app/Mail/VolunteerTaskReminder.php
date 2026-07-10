<?php

namespace App\Mail;

use App\Models\User;
use App\Models\VolunteerTask;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VolunteerTaskReminder extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $volunteer,
        public VolunteerTask $task,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Volunteer Reminder — ' . $this->task->event->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.volunteer-task-reminder',
        );
    }
}

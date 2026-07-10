<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventApprovalStatus extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $organizer,
        public Event $event,
        public bool $approved,
    ) {}

    public function envelope(): Envelope
    {
        $subject = $this->approved
            ? 'Your Event Has Been Approved — ' . $this->event->title
            : 'Your Event Was Not Approved — ' . $this->event->title;

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.event-approval-status',
        );
    }
}

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; background: #f9fafb; margin: 0; padding: 0; }
        .wrap { max-width: 560px; margin: 40px auto; background: #fff; border-radius: 12px; overflow: hidden; border: 1px solid #e5e7eb; }
        .header { padding: 32px 36px; color: #fff; }
        .header.approved { background: linear-gradient(135deg, #16a34a, #065f46); }
        .header.rejected { background: linear-gradient(135deg, #dc2626, #7f1d1d); }
        .header h1 { margin: 0; font-size: 22px; }
        .body { padding: 32px 36px; color: #374151; line-height: 1.6; }
        .detail { border-radius: 6px; padding: 16px 20px; margin: 20px 0; border-left: 4px solid; }
        .detail.approved { background: #f0fdf4; border-color: #16a34a; }
        .detail.rejected { background: #fef2f2; border-color: #dc2626; }
        .detail p { margin: 4px 0; font-size: 14px; }
        .btn { display: inline-block; padding: 12px 28px; border-radius: 8px; text-decoration: none; font-weight: 600; margin-top: 20px; color: #fff; }
        .btn.approved { background: #16a34a; }
        .btn.rejected { background: #6b7280; }
        .footer { padding: 20px 36px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #f3f4f6; }
    </style>
</head>
<body>
<div class="wrap">
    <div class="header {{ $approved ? 'approved' : 'rejected' }}">
        <h1>{{ $approved ? 'Event Approved ✅' : 'Event Not Approved ❌' }}</h1>
    </div>
    <div class="body">
        <p>Hi {{ $organizer->name }},</p>
        @if($approved)
            <p>Great news! Your event has been reviewed and <strong>approved</strong>. It is now live in the public catalog.</p>
        @else
            <p>After review, your event was <strong>not approved</strong>. Please contact an admin if you have questions or would like to resubmit.</p>
        @endif
        <div class="detail {{ $approved ? 'approved' : 'rejected' }}">
            <p><strong>{{ $event->title }}</strong></p>
            <p>📅 {{ $event->date->format('l, F j, Y') }}</p>
            <p>📍 {{ $event->location }}</p>
        </div>
        @if($approved)
            <a href="{{ route('events.show', $event) }}" class="btn approved">View Event</a>
        @else
            <a href="{{ route('organizer.dashboard') }}" class="btn rejected">Go to Dashboard</a>
        @endif
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} {{ config('app.name') }} &mdash; You're receiving this because you submitted an event.
    </div>
</div>
</body>
</html>

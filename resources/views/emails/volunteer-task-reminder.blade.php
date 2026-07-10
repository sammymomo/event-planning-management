<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; background: #f9fafb; margin: 0; padding: 0; }
        .wrap { max-width: 560px; margin: 40px auto; background: #fff; border-radius: 12px; overflow: hidden; border: 1px solid #e5e7eb; }
        .header { background: linear-gradient(135deg, #2563eb, #1e3a8a); padding: 32px 36px; color: #fff; }
        .header h1 { margin: 0; font-size: 22px; }
        .body { padding: 32px 36px; color: #374151; line-height: 1.6; }
        .detail { background: #eff6ff; border-left: 4px solid #2563eb; border-radius: 6px; padding: 16px 20px; margin: 20px 0; }
        .detail p { margin: 4px 0; font-size: 14px; }
        .btn { display: inline-block; background: #2563eb; color: #fff; padding: 12px 28px; border-radius: 8px; text-decoration: none; font-weight: 600; margin-top: 20px; }
        .footer { padding: 20px 36px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #f3f4f6; }
    </style>
</head>
<body>
<div class="wrap">
    <div class="header">
        <h1>Volunteer Reminder 🤝</h1>
    </div>
    <div class="body">
        <p>Hi {{ $volunteer->name }},</p>
        <p>This is a friendly reminder that you are signed up to volunteer tomorrow. Here are your details:</p>
        <div class="detail">
            <p><strong>Event:</strong> {{ $task->event->title }}</p>
            <p><strong>Your Role:</strong> {{ $task->task_name }}</p>
            @if($task->description)
                <p><strong>Description:</strong> {{ $task->description }}</p>
            @endif
            <p>📅 {{ $task->event->date->format('l, F j, Y') }}</p>
            <p>📍 {{ $task->event->location }}</p>
        </div>
        <p>Thank you for giving your time to the community. See you tomorrow!</p>
        <a href="{{ route('volunteer.schedule.index') }}" class="btn">View My Schedule</a>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} {{ config('app.name') }} &mdash; You're receiving this because you signed up to volunteer.
    </div>
</div>
</body>
</html>

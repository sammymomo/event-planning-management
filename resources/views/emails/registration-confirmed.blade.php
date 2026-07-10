<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; background: #f9fafb; margin: 0; padding: 0; }
        .wrap { max-width: 560px; margin: 40px auto; background: #fff; border-radius: 12px; overflow: hidden; border: 1px solid #e5e7eb; }
        .header { background: linear-gradient(135deg, #16a34a, #065f46); padding: 32px 36px; color: #fff; }
        .header h1 { margin: 0; font-size: 22px; }
        .body { padding: 32px 36px; color: #374151; line-height: 1.6; }
        .detail { background: #f0fdf4; border-left: 4px solid #16a34a; border-radius: 6px; padding: 16px 20px; margin: 20px 0; }
        .detail p { margin: 4px 0; font-size: 14px; }
        .btn { display: inline-block; background: #16a34a; color: #fff; padding: 12px 28px; border-radius: 8px; text-decoration: none; font-weight: 600; margin-top: 20px; }
        .footer { padding: 20px 36px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #f3f4f6; }
    </style>
</head>
<body>
<div class="wrap">
    <div class="header">
        <h1>You're registered! 🎉</h1>
    </div>
    <div class="body">
        <p>Hi {{ $user->name }},</p>
        <p>Your registration for the following event has been confirmed:</p>
        <div class="detail">
            <p><strong>{{ $event->title }}</strong></p>
            <p>📅 {{ $event->date->format('l, F j, Y') }}</p>
            <p>📍 {{ $event->location }}</p>
        </div>
        <p>We look forward to seeing you there. You can manage your registrations from your dashboard at any time.</p>
        <a href="{{ route('member.registrations') }}" class="btn">View My Registrations</a>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} {{ config('app.name') }} &mdash; You're receiving this because you registered for an event.
    </div>
</div>
</body>
</html>

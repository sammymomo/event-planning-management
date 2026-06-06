<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Feedback;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        $logs = AuditLog::with('user')
            ->orderByDesc('timestamp')
            ->paginate(25);

        $stats = [
            'total_users'  => User::count(),
            'total_events' => Event::count(),
            'approved'     => Event::where('status', 'approved')->count(),
            'pending'      => Event::where('status', 'pending')->count(),
            'registrations' => EventRegistration::count(),
            'avg_rating'   => round(Feedback::avg('rating') ?? 0, 1),
        ];

        $topEvents = Event::withCount('registrations')
            ->where('status', 'approved')
            ->orderByDesc('registrations_count')
            ->limit(5)
            ->get();

        return view('admin.reports.index', compact('logs', 'stats', 'topEvents'));
    }
}

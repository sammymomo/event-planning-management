<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\VolunteerAssignment;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $assignments = VolunteerAssignment::with(['task.event'])
            ->where('user_id', Auth::id())
            ->orderBy('assigned_at', 'desc')
            ->get();

        return view('volunteer.schedule', compact('assignments'));
    }
}

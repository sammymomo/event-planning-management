<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\VolunteerAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvailabilityController extends Controller
{
    public function edit()
    {
        $assignments = VolunteerAssignment::with('task.event')
            ->where('user_id', Auth::id())
            ->get();

        return view('volunteer.availability', compact('assignments'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'availability'   => ['required', 'array'],
            'availability.*' => ['nullable', 'string', 'max:255'],
        ]);

        foreach ($request->availability as $assignmentId => $value) {
            VolunteerAssignment::where('id', $assignmentId)
                ->where('user_id', Auth::id())
                ->update(['availability' => $value ?: null]);
        }

        return back()->with('success', 'Availability updated.');
    }
}

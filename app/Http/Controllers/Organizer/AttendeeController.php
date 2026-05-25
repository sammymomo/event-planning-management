<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AttendeeController extends Controller
{
    use AuthorizesRequests;

    public function index(Event $event)
    {
        $this->authorize('update', $event);

        $registrations = $event->registrations()
            ->with('user')
            ->orderBy('registered_at')
            ->get();

        return view('organizer.events.attendees', compact('event', 'registrations'));
    }

    public function export(Event $event)
    {
        $this->authorize('update', $event);

        $registrations = $event->registrations()->with('user')->orderBy('registered_at')->get();

        $csv = "Name,Email,Phone,Status,Registered At\n";
        foreach ($registrations as $reg) {
            $csv .= implode(',', [
                '"' . $reg->user->name . '"',
                '"' . $reg->user->email . '"',
                '"' . ($reg->user->phone ?? '') . '"',
                '"' . $reg->status->value . '"',
                '"' . $reg->registered_at . '"',
            ]) . "\n";
        }

        $filename = 'attendees-' . str($event->title)->slug() . '.csv';

        return response($csv, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }
}

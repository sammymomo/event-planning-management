<x-app-layout>
    <!-- Header -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Organizer Dashboard</h1>
                <p class="text-gray-500 mt-1">Manage your events and track attendance</p>
            </div>
            <a href="{{ route('organizer.events.create') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition">
                + Create Event
            </a>
        </div>
    </div>

    <div class="bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Stats -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-5 text-center">
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                    <p class="text-sm text-gray-500 mt-1">Total Events</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 text-center">
                    <p class="text-3xl font-bold text-green-600">{{ $stats['upcoming'] }}</p>
                    <p class="text-sm text-gray-500 mt-1">Upcoming</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 text-center">
                    <p class="text-3xl font-bold text-yellow-500">{{ $stats['pending'] }}</p>
                    <p class="text-sm text-gray-500 mt-1">Pending Approval</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 text-center">
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['attendees'] }}</p>
                    <p class="text-sm text-gray-500 mt-1">Total Registrations</p>
                </div>
            </div>

            <!-- Events Table -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="font-semibold text-gray-900">My Events</h2>
                </div>

                @if($events->isEmpty())
                    <div class="text-center py-16">
                        <div class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">No events yet</p>
                        <p class="text-sm text-gray-400 mt-1">Create your first event to get started.</p>
                        <a href="{{ route('organizer.events.create') }}"
                           class="inline-block mt-4 bg-green-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition">
                            Create Event
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                                <tr>
                                    <th class="px-6 py-3 text-left">Event</th>
                                    <th class="px-6 py-3 text-left">Date</th>
                                    <th class="px-6 py-3 text-left">Status</th>
                                    <th class="px-6 py-3 text-center">Registrations</th>
                                    <th class="px-6 py-3 text-center">Vol. Tasks</th>
                                    <th class="px-6 py-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($events as $event)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4">
                                            <p class="font-medium text-gray-900">{{ $event->title }}</p>
                                            <p class="text-xs text-gray-400 truncate max-w-xs">{{ $event->location }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                            {{ $event->date->format('M j, Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $statusClass = match($event->status->value) {
                                                    'approved' => 'bg-green-100 text-green-700',
                                                    'pending'  => 'bg-yellow-100 text-yellow-700',
                                                    'canceled' => 'bg-red-100 text-red-700',
                                                    default    => 'bg-gray-100 text-gray-600',
                                                };
                                            @endphp
                                            <span class="inline-block {{ $statusClass }} text-xs font-semibold px-2.5 py-1 rounded-full capitalize">
                                                {{ $event->status->value }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center text-gray-700 font-medium">
                                            {{ $event->registrations_count }}
                                        </td>
                                        <td class="px-6 py-4 text-center text-gray-700 font-medium">
                                            {{ $event->volunteer_tasks_count }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-3">
                                                <a href="{{ route('organizer.events.attendees', $event) }}"
                                                   class="text-xs text-gray-500 hover:text-green-600 transition">Attendees</a>
                                                <a href="{{ route('organizer.events.feedback', $event) }}"
                                                   class="text-xs text-gray-500 hover:text-green-600 transition">Feedback</a>
                                                <a href="{{ route('organizer.events.edit', $event) }}"
                                                   class="text-xs font-semibold text-green-600 hover:text-green-700 transition">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

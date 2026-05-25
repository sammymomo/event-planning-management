<x-app-layout>
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                    <a href="{{ route('organizer.dashboard') }}" class="hover:text-green-600 transition">Dashboard</a>
                    <span>/</span>
                    <span class="text-gray-800 font-medium">Attendees</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $event->title }}</h1>
                <p class="text-gray-500 mt-1">{{ $registrations->count() }} {{ Str::plural('registration', $registrations->count()) }}</p>
            </div>
            <a href="{{ route('organizer.events.attendees.export', $event) }}"
               class="flex items-center gap-2 border border-gray-300 text-gray-700 hover:border-green-500 hover:text-green-600 px-4 py-2.5 rounded-lg text-sm font-medium transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Export CSV
            </a>
        </div>
    </div>

    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                @if($registrations->isEmpty())
                    <div class="text-center py-16">
                        <div class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">No registrations yet</p>
                        <p class="text-sm text-gray-400 mt-1">Attendees will appear here once they register.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                                <tr>
                                    <th class="px-6 py-3 text-left">#</th>
                                    <th class="px-6 py-3 text-left">Name</th>
                                    <th class="px-6 py-3 text-left">Email</th>
                                    <th class="px-6 py-3 text-left">Phone</th>
                                    <th class="px-6 py-3 text-left">Status</th>
                                    <th class="px-6 py-3 text-left">Registered</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($registrations as $i => $reg)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 text-gray-400">{{ $i + 1 }}</td>
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $reg->user->name }}</td>
                                        <td class="px-6 py-4 text-gray-600">{{ $reg->user->email }}</td>
                                        <td class="px-6 py-4 text-gray-500">{{ $reg->user->phone ?? '—' }}</td>
                                        <td class="px-6 py-4">
                                            @php
                                                $cls = match($reg->status->value) {
                                                    'confirmed' => 'bg-green-100 text-green-700',
                                                    'attended'  => 'bg-blue-100 text-blue-700',
                                                    'canceled'  => 'bg-red-100 text-red-600',
                                                    default     => 'bg-gray-100 text-gray-600',
                                                };
                                            @endphp
                                            <span class="inline-block {{ $cls }} text-xs font-semibold px-2.5 py-1 rounded-full capitalize">
                                                {{ $reg->status->value }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-500 whitespace-nowrap">
                                            {{ $reg->registered_at ? \Carbon\Carbon::parse($reg->registered_at)->format('M j, Y') : '—' }}
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

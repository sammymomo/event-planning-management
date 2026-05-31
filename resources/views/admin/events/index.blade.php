<x-app-layout>
    @include('admin.partials.tabs')

    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Pending Events -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="font-semibold text-gray-900">Pending Approval</h2>
                    <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-2.5 py-1 rounded-full">
                        {{ $pending->count() }} pending
                    </span>
                </div>

                @if($pending->isEmpty())
                    <div class="text-center py-12">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">All caught up!</p>
                        <p class="text-sm text-gray-400 mt-1">No events waiting for approval.</p>
                    </div>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach($pending as $event)
                            <div class="px-6 py-5 flex flex-col sm:flex-row sm:items-start gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h3 class="font-semibold text-gray-900">{{ $event->title }}</h3>
                                    </div>
                                    <div class="flex flex-wrap gap-4 text-xs text-gray-500 mt-1">
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $event->date->format('M j, Y') }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            {{ $event->location }}
                                        </span>
                                        <span>By {{ $event->organizer->name }}</span>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ $event->description }}</p>
                                </div>
                                <div class="flex items-center gap-2 shrink-0">
                                    <form method="POST" action="{{ route('admin.events.approve', $event) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                                            Approve
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.events.reject', $event) }}"
                                          onsubmit="return confirm('Reject this event?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="bg-red-50 hover:bg-red-100 text-red-600 text-sm font-semibold px-4 py-2 rounded-lg border border-red-200 transition">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Recently Processed -->
            @if($recent->isNotEmpty())
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-900">Recently Processed</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                                <tr>
                                    <th class="px-6 py-3 text-left">Event</th>
                                    <th class="px-6 py-3 text-left">Organizer</th>
                                    <th class="px-6 py-3 text-left">Date</th>
                                    <th class="px-6 py-3 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($recent as $event)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $event->title }}</td>
                                        <td class="px-6 py-4 text-gray-500">{{ $event->organizer->name }}</td>
                                        <td class="px-6 py-4 text-gray-500">{{ $event->date->format('M j, Y') }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-block {{ $event->status->value === 'approved' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }} text-xs font-semibold px-2.5 py-1 rounded-full capitalize">
                                                {{ $event->status->value }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>

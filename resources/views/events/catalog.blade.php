<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Browse Events</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Filters -->
        <form method="GET" action="{{ route('events.index') }}" class="bg-white rounded-xl shadow-sm p-4 mb-8 flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search by title or location..."
                class="flex-1 border-gray-300 rounded-md shadow-sm text-sm focus:ring-indigo-500 focus:border-indigo-500">

            <input type="date" name="from" value="{{ request('from') }}"
                class="border-gray-300 rounded-md shadow-sm text-sm focus:ring-indigo-500 focus:border-indigo-500">

            <input type="date" name="to" value="{{ request('to') }}"
                class="border-gray-300 rounded-md shadow-sm text-sm focus:ring-indigo-500 focus:border-indigo-500">

            <button type="submit"
                class="bg-indigo-600 text-white px-5 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition">
                Search
            </button>

            @if(request()->hasAny(['search', 'from', 'to', 'location']))
                <a href="{{ route('events.index') }}"
                   class="text-sm text-gray-500 hover:text-gray-700 flex items-center">Clear</a>
            @endif
        </form>

        <!-- Results -->
        @if($events->isEmpty())
            <div class="text-center py-20 text-gray-400">
                <p class="text-lg">No upcoming events found.</p>
                <p class="text-sm mt-1">Try adjusting your search or check back later.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($events as $event)
                    <a href="{{ route('events.show', $event) }}"
                       class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden flex flex-col">
                        <div class="bg-indigo-50 px-6 py-5 flex-none">
                            <p class="text-xs font-medium text-indigo-500 uppercase tracking-wide">
                                {{ $event->date->format('D, M j, Y') }}
                            </p>
                            <h3 class="mt-1 text-base font-semibold text-gray-900 line-clamp-2">{{ $event->title }}</h3>
                        </div>
                        <div class="px-6 py-4 flex-1 flex flex-col justify-between">
                            <p class="text-sm text-gray-500 line-clamp-2">{{ $event->description }}</p>
                            <div class="mt-4 flex items-center gap-2 text-xs text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $event->location }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $events->links() }}
            </div>
        @endif
    </div>
</x-app-layout>

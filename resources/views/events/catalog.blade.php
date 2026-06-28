<x-app-layout>
    <!-- Page Header -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-2xl font-bold text-gray-900">Community Events</h1>
            <p class="text-gray-500 mt-1">Find and join events happening in your community</p>
        </div>
    </div>

    <div class="bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Filters -->
            <form method="GET" action="{{ route('events.index') }}"
                  class="bg-white rounded-xl shadow-sm p-4 mb-6 space-y-3">
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search events by title or location..."
                            class="w-full pl-9 border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                    </div>
                    <input type="date" name="from" value="{{ request('from') }}"
                        class="border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                    <input type="date" name="to" value="{{ request('to') }}"
                        class="border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                    <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition">
                        Search
                    </button>
                    @if(request()->hasAny(['search', 'from', 'to', 'category']))
                        <a href="{{ route('events.index') }}"
                           class="text-sm text-gray-500 hover:text-gray-700 flex items-center px-2">Clear</a>
                    @endif
                </div>

                <!-- Category pills -->
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('events.index', array_merge(request()->except('category', 'page'), [])) }}"
                       class="text-xs font-semibold px-3 py-1.5 rounded-full transition {{ !request('category') ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        All
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('events.index', array_merge(request()->except('category', 'page'), ['category' => $cat])) }}"
                           class="text-xs font-semibold px-3 py-1.5 rounded-full transition {{ request('category') === $cat ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            </form>

            <!-- Results -->
            @if($events->isEmpty())
                <div class="text-center py-20">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium">No events found</p>
                    <p class="text-sm text-gray-400 mt-1">Try adjusting your search or check back later.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($events as $event)
                        @php
                            $gradients = [
                                'from-green-600 to-green-900',
                                'from-blue-600 to-blue-900',
                                'from-purple-600 to-purple-900',
                                'from-orange-500 to-orange-800',
                                'from-teal-600 to-teal-900',
                            ];
                            $gradient = $gradients[$event->id % count($gradients)];
                            $registrationCount = $event->registrations()->count();
                            $taskCount = $event->volunteerTasks()->count();
                        @endphp
                        <a href="{{ route('events.show', $event) }}"
                           class="group bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col border border-gray-100">
                            <!-- Image / Gradient Banner -->
                            <div class="h-48 relative overflow-hidden">
                                @if($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}"
                                         alt="{{ $event->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br {{ $gradient }} group-hover:scale-105 transition-transform duration-500"></div>
                                @endif

                                <!-- Category badge -->
                                @if($event->category)
                                    <span class="absolute top-3 left-3 bg-white/90 text-gray-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                                        {{ $event->category }}
                                    </span>
                                @endif

                                <!-- Date badge -->
                                <div class="absolute top-3 right-3 bg-white/90 text-gray-800 text-center px-2.5 py-1 rounded-xl min-w-[44px]">
                                    <div class="text-lg font-extrabold leading-none">{{ $event->date->format('j') }}</div>
                                    <div class="text-xs uppercase tracking-wide">{{ $event->date->format('M') }}</div>
                                </div>

                                <!-- Bottom overlay stats -->
                                <div class="absolute bottom-0 left-0 right-0 p-3 bg-gradient-to-t from-black/50 to-transparent flex items-end gap-3">
                                    @if($registrationCount > 0)
                                        <span class="text-white text-xs flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{ $registrationCount }} registered
                                        </span>
                                    @endif
                                    @if($taskCount > 0)
                                        <span class="text-white text-xs flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0" />
                                            </svg>
                                            {{ $taskCount }} volunteer {{ Str::plural('role', $taskCount) }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="p-5 flex flex-col flex-1">
                                <h3 class="font-semibold text-gray-900 group-hover:text-green-700 transition line-clamp-1">
                                    {{ $event->title }}
                                </h3>
                                <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="truncate">{{ $event->location }}</span>
                                </p>
                                <p class="text-sm text-gray-500 mt-2 line-clamp-2 flex-1">{{ $event->description }}</p>

                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold text-xs shrink-0">
                                            {{ strtoupper(substr($event->organizer->name, 0, 1)) }}
                                        </div>
                                        <span class="text-xs text-gray-400">{{ $event->organizer->name }}</span>
                                    </div>
                                    <span class="text-xs font-semibold text-green-600 group-hover:underline">View details →</span>
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
    </div>
</x-app-layout>

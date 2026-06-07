<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Header -->
            <div class="bg-gradient-to-br from-green-700 to-green-900 rounded-xl p-6 text-white">
                <p class="text-green-200 text-sm">Welcome back,</p>
                <h1 class="text-2xl font-bold mt-0.5">{{ Auth::user()->name }}</h1>
            </div>

            <!-- Quick links -->
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('events.index') }}"
                   class="bg-white rounded-xl shadow-sm p-5 flex items-center gap-4 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Browse Events</p>
                        <p class="text-xs text-gray-400">Find something to join</p>
                    </div>
                </a>
                <a href="{{ route('member.registrations') }}"
                   class="bg-white rounded-xl shadow-sm p-5 flex items-center gap-4 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">My Registrations</p>
                        <p class="text-xs text-gray-400">View your sign-ups</p>
                    </div>
                </a>
            </div>

            <!-- Upcoming events -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-gray-900">Upcoming Events</h2>
                </div>
                @forelse($upcomingRegistrations as $reg)
                    <div class="px-6 py-4 flex items-center justify-between border-b border-gray-50 last:border-0 hover:bg-gray-50 transition">
                        <div>
                            <a href="{{ route('events.show', $reg->event) }}"
                               class="font-medium text-gray-900 hover:text-green-700 transition text-sm">
                                {{ $reg->event->title }}
                            </a>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $reg->event->date->format('M j, Y') }} &middot; {{ $reg->event->location }}</p>
                        </div>
                        <span class="text-xs bg-green-100 text-green-700 font-semibold px-2.5 py-1 rounded-full shrink-0">Confirmed</span>
                    </div>
                @empty
                    <div class="px-6 py-10 text-center text-gray-400 text-sm">
                        No upcoming events.
                        <a href="{{ route('events.index') }}" class="text-green-600 hover:underline ml-1">Browse events</a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>

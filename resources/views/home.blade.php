<x-app-layout>
    <!-- Hero -->
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 leading-tight">
                Bringing Communities Together,<br class="hidden sm:block"> One Event at a Time
            </h1>
            <p class="mt-6 text-lg text-gray-600 max-w-2xl mx-auto">
                Discover local events, volunteer your time, sponsor causes you care about, and connect with people in your community.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('events.index') }}"
                   class="inline-block bg-indigo-600 text-white px-8 py-3 rounded-lg text-base font-semibold hover:bg-indigo-700 transition">
                    Browse Events
                </a>
                @guest
                <a href="{{ route('register') }}"
                   class="inline-block bg-white text-indigo-600 border border-indigo-600 px-8 py-3 rounded-lg text-base font-semibold hover:bg-indigo-50 transition">
                    Get Started
                </a>
                @endguest
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 text-center mb-12">Everything you need to run great events</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white rounded-xl p-6 shadow-sm text-center">
                    <div class="text-3xl mb-3">📅</div>
                    <h3 class="font-semibold text-gray-900 mb-2">Organizers</h3>
                    <p class="text-sm text-gray-500">Create and manage events, track registrations, and collect feedback from attendees.</p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm text-center">
                    <div class="text-3xl mb-3">🎟️</div>
                    <h3 class="font-semibold text-gray-900 mb-2">Community Members</h3>
                    <p class="text-sm text-gray-500">Browse upcoming events, register with one click, and share your experience afterwards.</p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm text-center">
                    <div class="text-3xl mb-3">🤝</div>
                    <h3 class="font-semibold text-gray-900 mb-2">Volunteers</h3>
                    <p class="text-sm text-gray-500">Sign up for tasks, set your availability, and make a real difference at local events.</p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm text-center">
                    <div class="text-3xl mb-3">💼</div>
                    <h3 class="font-semibold text-gray-900 mb-2">Sponsors</h3>
                    <p class="text-sm text-gray-500">Support community events, gain visibility, and receive detailed impact reports.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="bg-indigo-600 py-14 text-center">
        <h2 class="text-2xl font-bold text-white mb-4">Ready to get involved?</h2>
        <p class="text-indigo-200 mb-8">Join hundreds of community members already on the platform.</p>
        @guest
            <a href="{{ route('register') }}"
               class="inline-block bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition">
                Create your free account
            </a>
        @else
            <a href="{{ route('events.index') }}"
               class="inline-block bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition">
                Browse Events
            </a>
        @endguest
    </div>
</x-app-layout>

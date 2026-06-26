<x-app-layout>
    @include('sponsor.partials.tabs')

    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div>
                <a href="{{ route('sponsor.dashboard') }}" class="text-sm text-green-600 hover:underline">&larr; Back to Dashboard</a>
                <h1 class="text-2xl font-bold text-gray-900 mt-2">Impact Report</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $sponsorship->event->title }} &middot; {{ $sponsorship->event->date->format('M j, Y') }}</p>
            </div>

            <!-- Sponsorship Summary -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="font-semibold text-gray-900 mb-4">Your Contribution</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-2xl font-bold text-green-700">${{ number_format($sponsorship->amount, 2) }}</p>
                        <p class="text-xs text-gray-500 mt-1">Amount</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-2xl font-bold text-green-700 capitalize">{{ $sponsorship->resource_type }}</p>
                        <p class="text-xs text-gray-500 mt-1">Resource Type</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-2xl font-bold {{ $sponsorship->acknowledged ? 'text-green-700' : 'text-yellow-600' }}">
                            {{ $sponsorship->acknowledged ? 'Acknowledged' : 'Pending' }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Status</p>
                    </div>
                </div>
            </div>

            <!-- Event Impact -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="font-semibold text-gray-900 mb-4">Event Impact</h2>
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-3xl font-bold text-green-700">{{ $attendeeCount }}</p>
                        <p class="text-xs text-gray-500 mt-1">Attendees</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-3xl font-bold text-green-700">{{ $avgRating > 0 ? $avgRating : '—' }}</p>
                        <p class="text-xs text-gray-500 mt-1">Avg Rating</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-3xl font-bold text-green-700">{{ $totalFeedback }}</p>
                        <p class="text-xs text-gray-500 mt-1">Reviews</p>
                    </div>
                </div>

                @if($attendeeCount === 0 && $totalFeedback === 0)
                    <p class="text-sm text-gray-400 text-center mt-6">Impact data will appear here once the event has taken place.</p>
                @endif
            </div>

            @if($sponsorship->acknowledged)
                <div class="text-center">
                    <a href="{{ route('sponsor.sponsorships.acknowledgment', $sponsorship) }}"
                       class="inline-block bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-6 py-2 rounded-lg transition">
                        View Acknowledgment Certificate
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>

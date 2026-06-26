<x-app-layout>
    @include('sponsor.partials.tabs')

    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm overflow-hidden">

                <!-- Header -->
                <div class="bg-gradient-to-br from-green-700 to-green-900 px-8 py-10 text-center text-white">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold">Thank You!</h1>
                    <p class="text-green-200 mt-2">Your sponsorship has been acknowledged by the organizer.</p>
                </div>

                <!-- Certificate Body -->
                <div class="px-8 py-8 space-y-6">
                    <div class="text-center">
                        <p class="text-gray-500 text-sm">This certifies that</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $sponsorship->sponsor->name }}</p>
                        <p class="text-gray-500 text-sm mt-3">has generously sponsored</p>
                        <p class="text-xl font-semibold text-green-700 mt-1">{{ $sponsorship->event->title }}</p>
                        <p class="text-gray-400 text-sm mt-1">{{ $sponsorship->event->date->format('F j, Y') }}</p>
                    </div>

                    <div class="border border-gray-100 rounded-xl p-5 grid grid-cols-2 gap-4 text-center">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Contribution</p>
                            <p class="text-xl font-bold text-gray-900 mt-1">${{ number_format($sponsorship->amount, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Resource Type</p>
                            <p class="text-xl font-bold text-gray-900 mt-1 capitalize">{{ $sponsorship->resource_type }}</p>
                        </div>
                    </div>

                    <div class="flex gap-3 justify-center">
                        <button onclick="window.print()"
                                class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-5 py-2 rounded-lg transition">
                            Print Certificate
                        </button>
                        <a href="{{ route('sponsor.sponsorships.report', $sponsorship) }}"
                           class="border border-gray-200 hover:bg-gray-50 text-gray-700 text-sm font-semibold px-5 py-2 rounded-lg transition">
                            View Impact Report
                        </a>
                        <a href="{{ route('sponsor.dashboard') }}"
                           class="text-sm text-gray-400 hover:text-gray-600 px-5 py-2 rounded-lg transition">
                            Back
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

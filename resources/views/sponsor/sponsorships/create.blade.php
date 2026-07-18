<x-app-layout>
    @include('sponsor.partials.tabs')

    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <form method="POST" action="{{ route('sponsor.sponsorships.store') }}"
                  class="bg-white rounded-xl shadow-sm divide-y divide-gray-100">
                @csrf

                <div class="px-6 py-4">
                    <h2 class="font-semibold text-gray-900">Submit a Sponsorship</h2>
                    <p class="text-sm text-gray-500 mt-1">Sponsorships can only be submitted for approved events.</p>
                </div>

                <div class="px-6 py-5 space-y-5">

                    <!-- Event -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Event <span class="text-red-500">*</span></label>
                        <select name="event_id"
                                class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                            <option value="">Select an event...</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                    {{ $event->title }} — {{ $event->date->format('M j, Y') }}
                                </option>
                            @endforeach
                        </select>
                        @error('event_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        @if($events->isEmpty())
                            <p class="text-xs text-gray-400 mt-1">No approved events available at this time.</p>
                        @endif
                    </div>

                    <!-- Amount -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Amount (USD) <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">$</span>
                            <input type="number" name="amount" value="{{ old('amount') }}"
                                   min="1" step="0.01" placeholder="0.00"
                                   class="w-full pl-7 border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                        </div>
                        @error('amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Resource Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Resource Type <span class="text-red-500">*</span></label>
                        <input type="text" name="resource_type" value="{{ old('resource_type') }}"
                               placeholder="e.g. Financial, Equipment, Venue, Catering..."
                               class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                        @error('resource_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                </div>

                <div class="px-6 py-4 flex justify-end gap-3">
                    <a href="{{ route('sponsor.dashboard') }}"
                       class="text-sm text-gray-500 hover:text-gray-700 px-4 py-2 rounded-lg transition">
                        Cancel
                    </a>
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-6 py-2 rounded-lg transition">
                        Submit Sponsorship
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>

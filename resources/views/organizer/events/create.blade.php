<x-app-layout>
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('organizer.dashboard') }}" class="hover:text-green-600 transition">Dashboard</a>
                <span>/</span>
                <span class="text-gray-800 font-medium">Create Event</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Create New Event</h1>
            <p class="text-gray-500 mt-1">Fill in the details below. Your event will be submitted for admin approval.</p>
        </div>
    </div>

    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                    <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('organizer.events.store') }}" class="bg-white rounded-xl shadow-sm p-6 space-y-5">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Event Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                           placeholder="e.g. Annual Community Clean-Up Day"
                           class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Event Date</label>
                        <input type="date" id="date" name="date" value="{{ old('date') }}"
                               min="{{ today()->toDateString() }}"
                               class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}"
                               placeholder="e.g. Central Park, New York"
                               class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="description" name="description" rows="5"
                              placeholder="Describe your event — what to expect, who should attend, and any special instructions..."
                              class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">{{ old('description') }}</textarea>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('organizer.dashboard') }}"
                       class="text-sm text-gray-500 hover:text-gray-700 transition">Cancel</a>
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold transition">
                        Create Event
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>

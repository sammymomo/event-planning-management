<x-app-layout>
    @include('volunteer.partials.tabs')

    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <form method="POST" action="{{ route('volunteer.availability.update') }}"
                  class="bg-white rounded-xl shadow-sm overflow-hidden">
                @csrf
                @method('PATCH')

                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-gray-900">Update Availability</h2>
                    <p class="text-sm text-gray-500 mt-1">Add notes about when you are available for each task</p>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse($assignments as $assignment)
                        <div class="px-6 py-4">
                            <div class="mb-2">
                                <p class="font-medium text-gray-900 text-sm">{{ $assignment->task->task_name }}</p>
                                <p class="text-xs text-gray-400">{{ $assignment->task->event->title }} &middot; {{ $assignment->task->event->date->format('M j, Y') }}</p>
                            </div>
                            <input type="text"
                                   name="availability[{{ $assignment->id }}]"
                                   value="{{ old('availability.' . $assignment->id, $assignment->availability) }}"
                                   placeholder="e.g. Available after 2pm"
                                   class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                        </div>
                    @empty
                        <div class="px-6 py-10 text-center text-gray-400 text-sm">
                            No task assignments yet.
                            <a href="{{ route('volunteer.tasks.index') }}" class="text-green-600 hover:underline ml-1">Browse tasks</a>
                        </div>
                    @endforelse
                </div>

                @if($assignments->isNotEmpty())
                    <div class="px-6 py-4 border-t border-gray-100 flex justify-end">
                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-6 py-2 rounded-lg transition">
                            Save
                        </button>
                    </div>
                @endif
            </form>

        </div>
    </div>
</x-app-layout>

<x-app-layout>
    @include('volunteer.partials.tabs')

    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                            <tr>
                                <th class="px-6 py-3 text-left">Task</th>
                                <th class="px-6 py-3 text-left">Event</th>
                                <th class="px-6 py-3 text-left">Event Date</th>
                                <th class="px-6 py-3 text-left">Availability Note</th>
                                <th class="px-6 py-3 text-left">Signed Up</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($assignments as $assignment)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $assignment->task->task_name }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $assignment->task->event->title }}</td>
                                    <td class="px-6 py-4 text-gray-500 whitespace-nowrap">{{ $assignment->task->event->date->format('M j, Y') }}</td>
                                    <td class="px-6 py-4 text-gray-500">{{ $assignment->availability ?? '—' }}</td>
                                    <td class="px-6 py-4 text-gray-400 whitespace-nowrap">{{ $assignment->assigned_at->format('M j, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                        You haven't signed up for any tasks yet.
                                        <a href="{{ route('volunteer.tasks.index') }}" class="text-green-600 hover:underline ml-1">Browse tasks</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

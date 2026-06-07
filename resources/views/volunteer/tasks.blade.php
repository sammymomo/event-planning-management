<x-app-layout>
    @include('volunteer.partials.tabs')

    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-sm text-green-700">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-sm text-red-700">{{ session('error') }}</div>
            @endif

            @forelse($tasks as $task)
                <div class="bg-white rounded-xl shadow-sm p-5 flex flex-col sm:flex-row sm:items-start gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="font-semibold text-gray-900">{{ $task->task_name }}</h3>
                            @if($task->slots_remaining <= 0)
                                <span class="text-xs bg-red-100 text-red-600 font-semibold px-2 py-0.5 rounded-full">Full</span>
                            @else
                                <span class="text-xs bg-green-100 text-green-700 font-semibold px-2 py-0.5 rounded-full">
                                    {{ $task->slots_remaining }} slot{{ $task->slots_remaining !== 1 ? 's' : '' }} left
                                </span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5">{{ $task->event->title }} &middot; {{ $task->event->date->format('M j, Y') }}</p>
                        @if($task->description)
                            <p class="text-sm text-gray-600 mt-2">{{ $task->description }}</p>
                        @endif
                    </div>
                    <div class="shrink-0">
                        @if($task->signed_up)
                            <form method="POST" action="{{ route('volunteer.tasks.leave', $task) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-sm border border-red-300 text-red-600 hover:bg-red-50 font-semibold px-4 py-2 rounded-lg transition">
                                    Leave
                                </button>
                            </form>
                        @elseif($task->slots_remaining > 0)
                            <form method="POST" action="{{ route('volunteer.tasks.signup', $task) }}">
                                @csrf
                                <button type="submit"
                                        class="text-sm bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                                    Sign Up
                                </button>
                            </form>
                        @else
                            <span class="text-sm text-gray-400">No slots</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-sm p-12 text-center text-gray-400">
                    No volunteer tasks available right now.
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>

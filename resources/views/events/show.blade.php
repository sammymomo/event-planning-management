<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('events.index') }}" class="hover:text-indigo-600">Browse Events</a>
            <span>/</span>
            <span class="text-gray-800 font-medium">{{ $event->title }}</span>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Title & Meta -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $event->title }}</h1>
                    <div class="mt-3 flex flex-wrap gap-4 text-sm text-gray-500">
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $event->date->format('l, F j, Y') }}
                        </span>
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $event->location }}
                        </span>
                        @if($avgRating)
                            <span class="flex items-center gap-1 text-yellow-500">
                                ★ {{ number_format($avgRating, 1) }}
                                <span class="text-gray-400">({{ $event->feedback->count() }} reviews)</span>
                            </span>
                        @endif
                    </div>
                    <p class="mt-5 text-gray-600 leading-relaxed">{{ $event->description }}</p>
                </div>

                <!-- Volunteer Tasks -->
                @if($event->volunteerTasks->isNotEmpty())
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Volunteer Opportunities ({{ $taskCount }})</h2>
                        <ul class="divide-y divide-gray-100">
                            @foreach($event->volunteerTasks as $task)
                                <li class="py-3 flex justify-between items-center">
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $task->task_name }}</p>
                                        @if($task->description)
                                            <p class="text-sm text-gray-500">{{ $task->description }}</p>
                                        @endif
                                    </div>
                                    <span class="text-sm text-gray-400 whitespace-nowrap ml-4">
                                        {{ $task->slotsRemaining() }} / {{ $task->slots_available }} slots
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Feedback Summary -->
                @if($event->feedback->isNotEmpty())
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">What attendees said</h2>
                        <div class="space-y-4">
                            @foreach($event->feedback->take(5) as $fb)
                                <div class="border-b border-gray-100 pb-4 last:border-0">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-yellow-400">{{ str_repeat('★', $fb->rating) }}{{ str_repeat('☆', 5 - $fb->rating) }}</span>
                                        <span class="text-sm text-gray-400">{{ $fb->user->name }}</span>
                                    </div>
                                    @if($fb->comments)
                                        <p class="text-sm text-gray-600">{{ $fb->comments }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-4">
                <!-- Organizer -->
                <div class="bg-white rounded-xl shadow-sm p-5">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Organizer</h3>
                    <p class="font-medium text-gray-900">{{ $event->organizer->name }}</p>
                    <p class="text-sm text-gray-400">{{ $event->organizer->email }}</p>
                </div>

                <!-- Actions -->
                <div class="bg-white rounded-xl shadow-sm p-5 space-y-3">
                    @auth
                        @if(auth()->user()->isUser())
                            <form method="POST" action="{{ route('events.register', $event) }}">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-indigo-600 text-white py-2.5 rounded-lg font-semibold hover:bg-indigo-700 transition text-sm">
                                    Register for this Event
                                </button>
                            </form>
                        @endif

                        @if(auth()->user()->isVolunteer() && $event->volunteerTasks->isNotEmpty())
                            <a href="{{ route('volunteer.tasks.index') }}"
                               class="block w-full text-center border border-indigo-600 text-indigo-600 py-2.5 rounded-lg font-semibold hover:bg-indigo-50 transition text-sm">
                                View Volunteer Tasks
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                           class="block w-full text-center bg-indigo-600 text-white py-2.5 rounded-lg font-semibold hover:bg-indigo-700 transition text-sm">
                            Log in to Register
                        </a>
                        <a href="{{ route('register') }}"
                           class="block w-full text-center border border-gray-300 text-gray-700 py-2.5 rounded-lg font-semibold hover:bg-gray-50 transition text-sm">
                            Create an Account
                        </a>
                    @endauth
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

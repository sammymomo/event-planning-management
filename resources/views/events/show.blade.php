<x-app-layout>
    <!-- Hero Banner -->
    <div class="relative bg-gradient-to-br from-green-700 to-green-950 text-white overflow-hidden">
        @if($event->image)
            <div class="absolute inset-0">
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                     class="w-full h-full object-cover opacity-25">
            </div>
        @endif
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative">
            <!-- Breadcrumb -->
            <div class="flex items-center gap-2 text-sm text-green-200 mb-6">
                <a href="{{ route('events.index') }}" class="hover:text-white transition">Browse Events</a>
                <span>/</span>
                <span class="text-white font-medium">{{ $event->title }}</span>
            </div>

            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="inline-block bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                            Upcoming
                        </span>
                        @if($event->category)
                            <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $event->category }}
                            </span>
                        @endif
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-bold leading-tight">{{ $event->title }}</h1>
                    <div class="mt-4 flex flex-wrap gap-5 text-sm text-green-100">
                        <span class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $event->date->format('l, F j, Y') }}
                        </span>
                        <span class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $event->location }}
                        </span>
                        @if($avgRating)
                            <span class="flex items-center gap-1">
                                <span class="text-yellow-300">★</span>
                                {{ number_format($avgRating, 1) }}
                                <span class="text-green-300">({{ $event->feedback->count() }} reviews)</span>
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Quick stats -->
                <div class="flex gap-6 text-center shrink-0">
                    <div class="bg-white/10 rounded-xl px-5 py-3">
                        <div class="text-2xl font-bold">{{ $event->registrations()->count() }}</div>
                        <div class="text-xs text-green-200 mt-0.5">Registered</div>
                    </div>
                    @if($taskCount > 0)
                        <div class="bg-white/10 rounded-xl px-5 py-3">
                            <div class="text-2xl font-bold">{{ $taskCount }}</div>
                            <div class="text-xs text-green-200 mt-0.5">Volunteer Roles</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- About -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-3">About This Event</h2>
                        <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $event->description }}</p>
                    </div>

                    <!-- Volunteer Tasks -->
                    @if($event->volunteerTasks->isNotEmpty())
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-lg font-semibold text-gray-900">Volunteer Opportunities</h2>
                                <span class="text-sm text-gray-400">{{ $taskCount }} {{ Str::plural('role', $taskCount) }} available</span>
                            </div>
                            <ul class="divide-y divide-gray-100">
                                @foreach($event->volunteerTasks as $task)
                                    @php $remaining = $task->slotsRemaining(); @endphp
                                    <li class="py-4 flex items-center justify-between gap-4">
                                        <div class="flex-1">
                                            <p class="font-medium text-gray-900">{{ $task->task_name }}</p>
                                            @if($task->description)
                                                <p class="text-sm text-gray-500 mt-0.5">{{ $task->description }}</p>
                                            @endif
                                        </div>
                                        <div class="text-right shrink-0">
                                            @if($remaining > 0)
                                                <span class="inline-block bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                                                    {{ $remaining }} / {{ $task->slots_available }} open
                                                </span>
                                            @else
                                                <span class="inline-block bg-gray-100 text-gray-500 text-xs font-semibold px-2.5 py-1 rounded-full">
                                                    Full
                                                </span>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Feedback -->
                    @if($event->feedback->isNotEmpty())
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <div class="flex items-center gap-4 mb-5">
                                <h2 class="text-lg font-semibold text-gray-900">Attendee Feedback</h2>
                                @if($avgRating)
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-2xl font-bold text-gray-900">{{ number_format($avgRating, 1) }}</span>
                                        <div class="text-yellow-400 text-lg">
                                            @for($i = 1; $i <= 5; $i++)
                                                {{ $i <= round($avgRating) ? '★' : '☆' }}
                                            @endfor
                                        </div>
                                        <span class="text-sm text-gray-400">({{ $event->feedback->count() }})</span>
                                    </div>
                                @endif
                            </div>
                            <div class="space-y-4">
                                @foreach($event->feedback->take(5) as $fb)
                                    <div class="border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="font-medium text-sm text-gray-800">{{ $fb->user->name }}</span>
                                            <span class="text-yellow-400 text-sm">
                                                {{ str_repeat('★', $fb->rating) }}{{ str_repeat('☆', 5 - $fb->rating) }}
                                            </span>
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

                    <!-- Flash messages -->
                    @if(session('success'))
                        <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-sm text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-sm text-red-700">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Register / Actions -->
                    <div class="bg-white rounded-xl shadow-sm p-5">
                        <h3 class="font-semibold text-gray-900 mb-4">Join This Event</h3>
                        @auth
                            @if(auth()->user()->isUser())
                                @php
                                    $myReg = $event->registrations->where('user_id', auth()->id())->whereNotIn('status', [\App\Enums\RegistrationStatus::Canceled])->first();
                                @endphp
                                @if($myReg)
                                    <div class="text-center py-2 mb-3">
                                        <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">You're registered!</span>
                                    </div>
                                    <form method="POST" action="{{ route('events.unregister', $event) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Cancel your registration?')"
                                            class="w-full border border-red-300 text-red-600 py-2.5 rounded-lg font-semibold hover:bg-red-50 transition text-sm">
                                            Cancel Registration
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('events.register', $event) }}">
                                        @csrf
                                        <button type="submit"
                                            class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition text-sm">
                                            Register Now
                                        </button>
                                    </form>
                                @endif
                            @elseif(auth()->user()->isVolunteer() && $event->volunteerTasks->isNotEmpty())
                                <a href="{{ route('volunteer.tasks.index') }}"
                                   class="block w-full text-center bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition text-sm">
                                    Sign Up to Volunteer
                                </a>
                            @elseif(auth()->user()->isSponsor())
                                <a href="{{ route('sponsor.sponsorships.create') }}"
                                   class="block w-full text-center bg-orange-500 text-white py-3 rounded-lg font-semibold hover:bg-orange-600 transition text-sm">
                                    Sponsor This Event
                                </a>
                            @else
                                <p class="text-sm text-gray-500 text-center py-2">You're signed in as {{ auth()->user()->role->value }}.</p>
                            @endif
                        @else
                            <a href="{{ route('register') }}"
                               class="block w-full text-center bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition text-sm mb-2">
                                Register for Free
                            </a>
                            <a href="{{ route('login') }}"
                               class="block w-full text-center border border-gray-300 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-50 transition text-sm">
                                Already have an account? Log in
                            </a>
                        @endauth
                    </div>

                    <!-- Organizer -->
                    <div class="bg-white rounded-xl shadow-sm p-5">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Organized By</h3>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold text-sm shrink-0">
                                {{ strtoupper(substr($event->organizer->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 text-sm">{{ $event->organizer->name }}</p>
                                <p class="text-xs text-gray-400">{{ $event->organizer->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Event Details -->
                    <div class="bg-white rounded-xl shadow-sm p-5">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Event Details</h3>
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-start gap-2.5 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-0.5 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $event->date->format('l, F j, Y') }}
                            </li>
                            <li class="flex items-start gap-2.5 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-0.5 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $event->location }}
                            </li>
                            <li class="flex items-start gap-2.5 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-0.5 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Status: <span class="font-medium text-green-600 capitalize">{{ $event->status->value }}</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

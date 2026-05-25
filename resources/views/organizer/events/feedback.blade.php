<x-app-layout>
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('organizer.dashboard') }}" class="hover:text-green-600 transition">Dashboard</a>
                <span>/</span>
                <span class="text-gray-800 font-medium">Feedback</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $event->title }}</h1>
            <p class="text-gray-500 mt-1">Attendee feedback and ratings</p>
        </div>
    </div>

    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Summary -->
            @if($feedback->isNotEmpty())
                <div class="bg-white rounded-xl shadow-sm p-6 flex flex-col sm:flex-row items-center gap-8">
                    <div class="text-center">
                        <p class="text-5xl font-bold text-gray-900">{{ number_format($avgRating, 1) }}</p>
                        <div class="text-yellow-400 text-2xl mt-1">
                            @for($i = 1; $i <= 5; $i++)
                                {{ $i <= round($avgRating) ? '★' : '☆' }}
                            @endfor
                        </div>
                        <p class="text-sm text-gray-400 mt-1">{{ $feedback->count() }} {{ Str::plural('review', $feedback->count()) }}</p>
                    </div>
                    <div class="flex-1 space-y-2 w-full">
                        @for($star = 5; $star >= 1; $star--)
                            @php $count = $feedback->where('rating', $star)->count(); @endphp
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-gray-500 w-4">{{ $star }}</span>
                                <span class="text-yellow-400 text-xs">★</span>
                                <div class="flex-1 bg-gray-100 rounded-full h-2">
                                    <div class="bg-yellow-400 h-2 rounded-full transition-all"
                                         style="width: {{ $feedback->count() > 0 ? ($count / $feedback->count()) * 100 : 0 }}%"></div>
                                </div>
                                <span class="text-xs text-gray-400 w-4">{{ $count }}</span>
                            </div>
                        @endfor
                    </div>
                </div>
            @endif

            <!-- Comments -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-gray-900">All Reviews</h2>
                </div>

                @if($feedback->isEmpty())
                    <div class="text-center py-16">
                        <p class="text-gray-500 font-medium">No feedback yet</p>
                        <p class="text-sm text-gray-400 mt-1">Feedback will appear here after attendees submit reviews.</p>
                    </div>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach($feedback as $fb)
                            <div class="px-6 py-5">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold text-xs">
                                            {{ strtoupper(substr($fb->user->name, 0, 1)) }}
                                        </div>
                                        <span class="font-medium text-sm text-gray-900">{{ $fb->user->name }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-yellow-400 text-sm">
                                            {{ str_repeat('★', $fb->rating) }}{{ str_repeat('☆', 5 - $fb->rating) }}
                                        </span>
                                        <span class="text-xs text-gray-400">
                                            {{ $fb->submitted_at ? \Carbon\Carbon::parse($fb->submitted_at)->format('M j, Y') : '' }}
                                        </span>
                                    </div>
                                </div>
                                @if($fb->comments)
                                    <p class="text-sm text-gray-600 ml-11">{{ $fb->comments }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

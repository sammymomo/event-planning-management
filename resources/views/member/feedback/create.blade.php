<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div>
                <a href="{{ route('events.show', $event) }}" class="text-sm text-green-600 hover:underline">&larr; Back to event</a>
                <h1 class="text-2xl font-bold text-gray-900 mt-2">Leave Feedback</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $event->title }}</p>
            </div>

            <form method="POST" action="{{ route('events.feedback.store', $event) }}"
                  class="bg-white rounded-xl shadow-sm p-6 space-y-6"
                  x-data="{ rating: 0 }">
                @csrf

                <!-- Star Rating -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Your Rating <span class="text-red-500">*</span></label>
                    <div class="flex gap-2">
                        @for($i = 1; $i <= 5; $i++)
                            <button type="button"
                                    @click="rating = {{ $i }}"
                                    class="text-3xl transition-transform hover:scale-110 focus:outline-none"
                                    :class="rating >= {{ $i }} ? 'text-yellow-400' : 'text-gray-300'">
                                &#9733;
                            </button>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" :value="rating">
                    @error('rating')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p x-show="rating === 0" class="text-xs text-gray-400 mt-1">Click a star to rate</p>
                </div>

                <!-- Comments -->
                <div>
                    <label for="comments" class="block text-sm font-medium text-gray-700 mb-1">Comments <span class="text-gray-400 font-normal">(optional)</span></label>
                    <textarea id="comments" name="comments" rows="4"
                              placeholder="Share your experience..."
                              class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500 resize-none">{{ old('comments') }}</textarea>
                    @error('comments')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        :disabled="rating === 0"
                        class="w-full bg-green-600 hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed text-white font-semibold py-3 rounded-lg transition text-sm">
                    Submit Feedback
                </button>
            </form>

        </div>
    </div>
</x-app-layout>

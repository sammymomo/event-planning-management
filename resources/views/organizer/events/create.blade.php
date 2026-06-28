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

            <form method="POST" action="{{ route('organizer.events.store') }}"
                  enctype="multipart/form-data"
                  class="bg-white rounded-xl shadow-sm p-6 space-y-5">
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
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select id="category" name="category"
                            class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                        <option value="">Select a category...</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="description" name="description" rows="5"
                              placeholder="Describe your event — what to expect, who should attend, and any special instructions..."
                              class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">{{ old('description') }}</textarea>
                </div>

                <!-- Cover Image -->
                <div x-data="{ preview: null }">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cover Image <span class="text-gray-400 font-normal">(optional, max 2MB)</span></label>
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-green-400 transition cursor-pointer"
                         @click="$refs.imageInput.click()">
                        <template x-if="!preview">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-sm text-gray-400">Click to upload a cover image</p>
                                <p class="text-xs text-gray-300 mt-1">JPG, PNG, GIF up to 2MB</p>
                            </div>
                        </template>
                        <template x-if="preview">
                            <img :src="preview" class="max-h-48 mx-auto rounded-lg object-cover">
                        </template>
                    </div>
                    <input type="file" name="image" id="image" accept="image/*" class="hidden" x-ref="imageInput"
                           @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">
                    @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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

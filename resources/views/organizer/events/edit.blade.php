<x-app-layout>
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('organizer.dashboard') }}" class="hover:text-green-600 transition">Dashboard</a>
                <span>/</span>
                <span class="text-gray-800 font-medium">Edit Event</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Event</h1>
            <p class="text-gray-500 mt-1">Update event details and manage volunteer tasks.</p>
        </div>
    </div>

    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                    <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Event Details Form -->
            <form method="POST" action="{{ route('organizer.events.update', $event) }}"
                  enctype="multipart/form-data"
                  class="bg-white rounded-xl shadow-sm p-6 space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Event Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}"
                           class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Event Date</label>
                        <input type="date" id="date" name="date" value="{{ old('date', $event->date->toDateString()) }}"
                               class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}"
                               class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                    </div>
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select id="category" name="category"
                            class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                        <option value="">Select a category...</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category', $event->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="description" name="description" rows="5"
                              class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">{{ old('description', $event->description) }}</textarea>
                </div>

                <!-- Cover Image -->
                <div x-data="{ preview: '{{ $event->image ? asset('storage/' . $event->image) : '' }}' }">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cover Image <span class="text-gray-400 font-normal">(optional, max 2MB)</span></label>
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-green-400 transition cursor-pointer"
                         @click="$refs.imageInput.click()">
                        <template x-if="!preview">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-sm text-gray-400">Click to upload a new cover image</p>
                            </div>
                        </template>
                        <template x-if="preview">
                            <img :src="preview" class="max-h-48 mx-auto rounded-lg object-cover">
                        </template>
                    </div>
                    <input type="file" name="image" id="image" accept="image/*" class="hidden" x-ref="imageInput"
                           @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : preview">
                    @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-between pt-2">
                    <span class="text-xs text-gray-400">
                        Status:
                        <span class="font-semibold capitalize {{ $event->status->value === 'approved' ? 'text-green-600' : ($event->status->value === 'pending' ? 'text-yellow-600' : 'text-red-600') }}">
                            {{ $event->status->value }}
                        </span>
                    </span>
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold transition">
                        Save Changes
                    </button>
                </div>
            </form>

            <!-- Volunteer Tasks -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="font-semibold text-gray-900 mb-4">Volunteer Tasks</h2>

                @if($event->volunteerTasks->isNotEmpty())
                    <ul class="divide-y divide-gray-100 mb-6">
                        @foreach($event->volunteerTasks as $task)
                            <li class="py-3 flex items-center justify-between gap-4">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800 text-sm">{{ $task->task_name }}</p>
                                    @if($task->description)
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $task->description }}</p>
                                    @endif
                                </div>
                                <div class="flex items-center gap-3 shrink-0">
                                    <span class="text-xs text-gray-400">{{ $task->slots_available }} slots</span>
                                    <form method="POST" action="{{ route('organizer.events.tasks.destroy', [$event, $task]) }}"
                                          onsubmit="return confirm('Remove this task?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-500 hover:text-red-700 transition">Remove</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-sm text-gray-400 mb-5">No volunteer tasks yet.</p>
                @endif

                <!-- Add Task Form -->
                <form method="POST" action="{{ route('organizer.events.tasks.store', $event) }}"
                      class="border border-dashed border-gray-200 rounded-xl p-4 space-y-3">
                    @csrf
                    <p class="text-sm font-medium text-gray-700">Add Volunteer Task</p>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div class="sm:col-span-2">
                            <input type="text" name="task_name" placeholder="Task name (e.g. Registration Desk)"
                                   class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <input type="number" name="slots_available" min="1" placeholder="Slots"
                                   class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                        </div>
                    </div>
                    <textarea name="description" rows="2" placeholder="Brief description (optional)"
                              class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500"></textarea>
                    <div class="text-right">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                            Add Task
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>

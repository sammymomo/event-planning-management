<x-app-layout>
    @include('admin.partials.tabs')

    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.settings.update') }}" class="bg-white rounded-xl shadow-sm divide-y divide-gray-100">
                @csrf
                @method('PATCH')

                <div class="px-6 py-4">
                    <h2 class="font-semibold text-gray-900">General</h2>
                </div>

                <div class="px-6 py-5 space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Application Name</label>
                        <input type="text" name="app_name" value="{{ old('app_name', $settings['app_name']) }}"
                               class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                        @error('app_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mail From Address</label>
                        <input type="email" name="mail_from" value="{{ old('mail_from', $settings['mail_from']) }}"
                               class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                        @error('mail_from') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="px-6 py-4">
                    <h2 class="font-semibold text-gray-900">Feature Toggles</h2>
                </div>

                <div class="px-6 py-5 space-y-4">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="registration_open" value="1"
                               {{ old('registration_open', $settings['registration_open']) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Open Registration</p>
                            <p class="text-xs text-gray-500">Allow members to register for events</p>
                        </div>
                    </label>

                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="require_event_approval" value="1"
                               {{ old('require_event_approval', $settings['require_event_approval']) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Require Event Approval</p>
                            <p class="text-xs text-gray-500">New events must be approved by an admin before going live</p>
                        </div>
                    </label>
                </div>

                <div class="px-6 py-4 flex justify-end">
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-6 py-2 rounded-lg transition">
                        Save Settings
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>

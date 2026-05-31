<x-app-layout>
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.users.index') }}" class="hover:text-green-600 transition">User Management</a>
                <span>/</span>
                <span class="text-gray-800 font-medium">Edit User</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
            <p class="text-gray-500 mt-1">{{ $user->email }}</p>
        </div>
    </div>

    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                    <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.users.update', $user) }}"
                  class="bg-white rounded-xl shadow-sm p-6 space-y-5">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select name="role" class="w-full border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                        @foreach(['user','organizer','volunteer','admin','sponsor'] as $r)
                            <option value="{{ $r }}" {{ $user->role->value === $r ? 'selected' : '' }}>
                                {{ ucfirst($r) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" id="blocked" name="blocked" value="1"
                           {{ $user->blocked ? 'checked' : '' }}
                           class="rounded border-gray-300 text-red-500 focus:ring-red-400">
                    <label for="blocked" class="text-sm text-gray-700">Block this user (prevents login)</label>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('admin.users.index') }}"
                       class="text-sm text-gray-500 hover:text-gray-700 transition">Cancel</a>
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold transition">
                        Save Changes
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>

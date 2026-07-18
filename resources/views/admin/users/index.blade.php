<x-app-layout>
    @include('admin.partials.tabs')

    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Filters -->
            <form method="GET" action="{{ route('admin.users.index') }}"
                  class="bg-white rounded-xl shadow-sm p-4 flex flex-col sm:flex-row gap-3">
                <div class="flex-1 relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search by name or email..."
                           class="w-full pl-9 border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                </div>
                <select name="role" class="border-gray-200 rounded-lg text-sm focus:ring-green-500 focus:border-green-500">
                    <option value="">All Roles</option>
                    @foreach(['user','organizer','volunteer','admin','sponsor'] as $r)
                        <option value="{{ $r }}" {{ request('role') === $r ? 'selected' : '' }}>
                            {{ ucfirst($r) }}
                        </option>
                    @endforeach
                </select>
                <button type="submit"
                        class="bg-green-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition">
                    Filter
                </button>
                @if(request()->hasAny(['search','role']))
                    <a href="{{ route('admin.users.index') }}"
                       class="text-sm text-gray-500 hover:text-gray-700 flex items-center px-2">Clear</a>
                @endif
            </form>

            <!-- Table -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                            <tr>
                                <th class="px-6 py-3 text-left">User</th>
                                <th class="px-6 py-3 text-left">Role</th>
                                <th class="px-6 py-3 text-left">Status</th>
                                <th class="px-6 py-3 text-left">Joined</th>
                                <th class="px-6 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($users as $user)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold text-xs shrink-0">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $user->name }}</p>
                                                <p class="text-xs text-gray-400">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-block bg-gray-100 text-gray-700 text-xs font-semibold px-2.5 py-1 rounded-full capitalize">
                                            {{ $user->role->value }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($user->blocked)
                                            <span class="inline-block bg-red-100 text-red-600 text-xs font-semibold px-2.5 py-1 rounded-full">Blocked</span>
                                        @else
                                            <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">Active</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 whitespace-nowrap">
                                        {{ $user->created_at->format('M j, Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-3">
                                            @if($user->id !== auth()->id())
                                                <form method="POST" action="{{ route('admin.users.toggle-block', $user) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="text-xs {{ $user->blocked ? 'text-green-600 hover:text-green-700' : 'text-red-500 hover:text-red-700' }} transition">
                                                        {{ $user->blocked ? 'Unblock' : 'Block' }}
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                               class="text-xs font-semibold text-green-600 hover:text-green-700 transition">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($users->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

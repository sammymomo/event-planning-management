<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div>
                <h1 class="text-2xl font-bold text-gray-900">My Registrations</h1>
                <p class="text-sm text-gray-500 mt-1">Events you have signed up for</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                            <tr>
                                <th class="px-6 py-3 text-left">Event</th>
                                <th class="px-6 py-3 text-left">Date</th>
                                <th class="px-6 py-3 text-left">Status</th>
                                <th class="px-6 py-3 text-left">Registered</th>
                                <th class="px-6 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($registrations as $reg)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <a href="{{ route('events.show', $reg->event) }}"
                                           class="font-medium text-gray-900 hover:text-green-700 transition">
                                            {{ $reg->event->title }}
                                        </a>
                                        <p class="text-xs text-gray-400 mt-0.5">{{ $reg->event->location }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 whitespace-nowrap">
                                        {{ $reg->event->date->format('M j, Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $colors = [
                                                'confirmed' => 'bg-green-100 text-green-700',
                                                'canceled'  => 'bg-gray-100 text-gray-500',
                                                'attended'  => 'bg-blue-100 text-blue-700',
                                            ];
                                            $color = $colors[$reg->status->value] ?? 'bg-gray-100 text-gray-500';
                                        @endphp
                                        <span class="inline-block {{ $color }} text-xs font-semibold px-2.5 py-1 rounded-full capitalize">
                                            {{ $reg->status->value }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-400 whitespace-nowrap">
                                        {{ $reg->registered_at->format('M j, Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        @if($reg->status->value === 'confirmed')
                                            <form method="POST" action="{{ route('events.unregister', $reg->event) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        onclick="return confirm('Cancel your registration for {{ addslashes($reg->event->title) }}?')"
                                                        class="text-xs text-red-500 hover:text-red-700 transition">
                                                    Cancel
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                        You haven't registered for any events yet.
                                        <a href="{{ route('events.index') }}" class="text-green-600 hover:underline ml-1">Browse events</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($registrations->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $registrations->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

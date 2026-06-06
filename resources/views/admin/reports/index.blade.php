<x-app-layout>
    @include('admin.partials.tabs')

    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Stats -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach([
                    ['label' => 'Total Users',    'value' => $stats['total_users']],
                    ['label' => 'Total Events',   'value' => $stats['total_events']],
                    ['label' => 'Approved',        'value' => $stats['approved']],
                    ['label' => 'Pending',         'value' => $stats['pending']],
                    ['label' => 'Registrations',   'value' => $stats['registrations']],
                    ['label' => 'Avg Rating',      'value' => $stats['avg_rating'] . ' / 5'],
                ] as $stat)
                    <div class="bg-white rounded-xl shadow-sm p-4 text-center">
                        <p class="text-2xl font-bold text-green-700">{{ $stat['value'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Top Events by Registrations -->
            @if($topEvents->isNotEmpty())
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-900">Top Events by Registrations</h2>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @foreach($topEvents as $i => $event)
                            <div class="px-6 py-3 flex items-center gap-4">
                                <span class="text-lg font-bold text-gray-300 w-6 text-center">{{ $i + 1 }}</span>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ $event->title }}</p>
                                    <p class="text-xs text-gray-400">{{ $event->date->format('M j, Y') }}</p>
                                </div>
                                <span class="text-sm font-semibold text-green-700">{{ $event->registrations_count }} registrants</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Audit Log -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-gray-900">Audit Log</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                            <tr>
                                <th class="px-6 py-3 text-left">User</th>
                                <th class="px-6 py-3 text-left">Action</th>
                                <th class="px-6 py-3 text-left">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($logs as $log)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-3 font-medium text-gray-900">
                                        {{ $log->user?->name ?? 'System' }}
                                    </td>
                                    <td class="px-6 py-3 text-gray-600">{{ $log->action }}</td>
                                    <td class="px-6 py-3 text-gray-400 whitespace-nowrap">
                                        {{ $log->timestamp->format('M j, Y g:i A') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-gray-400">No audit log entries yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($logs->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $logs->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

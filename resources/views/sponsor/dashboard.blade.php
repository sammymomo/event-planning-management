<x-app-layout>
    @include('sponsor.partials.tabs')

    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-sm text-green-700">{{ session('success') }}</div>
            @endif

            <!-- Stats -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach([
                    ['label' => 'Total Sponsorships', 'value' => $stats['total']],
                    ['label' => 'Acknowledged',        'value' => $stats['acknowledged']],
                    ['label' => 'Pending Acknowledgment', 'value' => $stats['pending']],
                    ['label' => 'Total Contributed',  'value' => '$' . number_format($stats['total_amount'], 2)],
                ] as $stat)
                    <div class="bg-white rounded-xl shadow-sm p-4 text-center">
                        <p class="text-2xl font-bold text-green-700">{{ $stat['value'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Sponsorships Table -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="font-semibold text-gray-900">My Sponsorships</h2>
                    <a href="{{ route('sponsor.sponsorships.create') }}"
                       class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                        + New Sponsorship
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                            <tr>
                                <th class="px-6 py-3 text-left">Event</th>
                                <th class="px-6 py-3 text-left">Amount</th>
                                <th class="px-6 py-3 text-left">Resource Type</th>
                                <th class="px-6 py-3 text-left">Status</th>
                                <th class="px-6 py-3 text-left">Date</th>
                                <th class="px-6 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($sponsorships as $sponsorship)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $sponsorship->event->title }}</td>
                                    <td class="px-6 py-4 text-gray-700">${{ number_format($sponsorship->amount, 2) }}</td>
                                    <td class="px-6 py-4 text-gray-500 capitalize">{{ $sponsorship->resource_type }}</td>
                                    <td class="px-6 py-4">
                                        @if($sponsorship->acknowledged)
                                            <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">Acknowledged</span>
                                        @else
                                            <span class="inline-block bg-yellow-100 text-yellow-700 text-xs font-semibold px-2.5 py-1 rounded-full">Pending</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-400 whitespace-nowrap">{{ $sponsorship->created_at->format('M j, Y') }}</td>
                                    <td class="px-6 py-4 text-right space-x-3">
                                        @if($sponsorship->acknowledged)
                                            <a href="{{ route('sponsor.sponsorships.acknowledgment', $sponsorship) }}"
                                               class="text-xs text-green-600 hover:text-green-700 font-semibold transition">
                                                View Acknowledgment
                                            </a>
                                        @endif
                                        <a href="{{ route('sponsor.sponsorships.report', $sponsorship) }}"
                                           class="text-xs text-gray-500 hover:text-gray-700 font-semibold transition">
                                            Report
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                        No sponsorships yet.
                                        <a href="{{ route('sponsor.sponsorships.create') }}" class="text-green-600 hover:underline ml-1">Submit one</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

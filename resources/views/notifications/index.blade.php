<x-app-layout>
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-2xl font-bold text-gray-900">Notifications</h1>
            <p class="text-gray-500 mt-1">All notifications are marked as read when you visit this page.</p>
        </div>
    </div>

    <div class="bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            @if($notifications->isEmpty())
                <div class="text-center py-20 bg-white rounded-2xl border border-gray-100">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-2.405A2.032 2.032 0 0118 13.516V10a6 6 0 10-12 0v3.516c0 .394-.143.765-.405 1.079L4 17h5m6 0a3 3 0 11-6 0"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium">No notifications yet</p>
                    <p class="text-sm text-gray-400 mt-1">You'll see updates here when you register for events, get approvals, and more.</p>
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 divide-y divide-gray-100">
                    @foreach($notifications as $notification)
                        <div class="flex items-start gap-4 px-6 py-4">
                            <div class="w-9 h-9 bg-green-100 rounded-full flex items-center justify-center shrink-0 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-2.405A2.032 2.032 0 0118 13.516V10a6 6 0 10-12 0v3.516c0 .394-.143.765-.405 1.079L4 17h5m6 0a3 3 0 11-6 0"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-800">{{ $notification->message }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $notifications->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>

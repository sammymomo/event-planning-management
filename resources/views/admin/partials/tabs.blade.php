<div class="bg-white border-b border-gray-100">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <h1 class="text-2xl font-bold text-gray-900">Admin Panel</h1>
        <div class="mt-4 flex gap-1">
            <a href="{{ route('admin.events.index') }}"
               class="px-4 py-2 text-sm font-medium rounded-t-lg {{ request()->routeIs('admin.events.*') ? 'bg-green-600 text-white' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100' }} transition">
                Event Approvals
            </a>
            <a href="{{ route('admin.users.index') }}"
               class="px-4 py-2 text-sm font-medium rounded-t-lg {{ request()->routeIs('admin.users.*') ? 'bg-green-600 text-white' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100' }} transition">
                Users
            </a>
            <a href="{{ route('admin.reports.index') }}"
               class="px-4 py-2 text-sm font-medium rounded-t-lg {{ request()->routeIs('admin.reports.*') ? 'bg-green-600 text-white' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100' }} transition">
                Reports
            </a>
            <a href="{{ route('admin.settings.index') }}"
               class="px-4 py-2 text-sm font-medium rounded-t-lg {{ request()->routeIs('admin.settings.*') ? 'bg-green-600 text-white' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100' }} transition">
                Settings
            </a>
        </div>
    </div>
</div>

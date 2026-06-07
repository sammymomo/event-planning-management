<div class="bg-white border-b border-gray-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <h1 class="text-2xl font-bold text-gray-900">Volunteer</h1>
        <div class="mt-4 flex gap-1">
            <a href="{{ route('volunteer.tasks.index') }}"
               class="px-4 py-2 text-sm font-medium rounded-t-lg {{ request()->routeIs('volunteer.tasks.index') ? 'bg-green-600 text-white' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100' }} transition">
                Task Board
            </a>
            <a href="{{ route('volunteer.schedule.index') }}"
               class="px-4 py-2 text-sm font-medium rounded-t-lg {{ request()->routeIs('volunteer.schedule.*') ? 'bg-green-600 text-white' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100' }} transition">
                My Schedule
            </a>
            <a href="{{ route('volunteer.availability.edit') }}"
               class="px-4 py-2 text-sm font-medium rounded-t-lg {{ request()->routeIs('volunteer.availability.*') ? 'bg-green-600 text-white' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100' }} transition">
                Availability
            </a>
        </div>
    </div>
</div>

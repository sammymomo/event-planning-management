<div class="bg-white border-b border-gray-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <h1 class="text-2xl font-bold text-gray-900">Sponsor Portal</h1>
        <div class="mt-4 flex gap-1">
            <a href="{{ route('sponsor.dashboard') }}"
               class="px-4 py-2 text-sm font-medium rounded-t-lg {{ request()->routeIs('sponsor.dashboard') ? 'bg-green-600 text-white' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100' }} transition">
                Dashboard
            </a>
            <a href="{{ route('sponsor.sponsorships.create') }}"
               class="px-4 py-2 text-sm font-medium rounded-t-lg {{ request()->routeIs('sponsor.sponsorships.create') ? 'bg-green-600 text-white' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100' }} transition">
                New Sponsorship
            </a>
        </div>
    </div>
</div>

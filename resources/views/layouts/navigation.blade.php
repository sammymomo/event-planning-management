<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center gap-2">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <x-application-logo class="w-8 h-8" />
                        <span class="text-base font-bold text-gray-900">{{ config('app.name') }}</span>
                    </a>
                </div>

                <!-- Desktop Nav Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')">
                        Browse Events
                    </x-nav-link>

                    @auth
                        @if(auth()->user()->isUser())
                            <x-nav-link :href="route('member.registrations')" :active="request()->routeIs('member.*')">
                                My Registrations
                            </x-nav-link>
                        @endif

                        @if(auth()->user()->isOrganizer())
                            <x-nav-link :href="route('organizer.dashboard')" :active="request()->routeIs('organizer.*')">
                                My Events
                            </x-nav-link>
                        @endif

                        @if(auth()->user()->isAdmin())
                            <x-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.*')">
                                Admin
                            </x-nav-link>
                        @endif

                        @if(auth()->user()->isVolunteer())
                            <x-nav-link :href="route('volunteer.tasks.index')" :active="request()->routeIs('volunteer.*')">
                                My Tasks
                            </x-nav-link>
                        @endif

                        @if(auth()->user()->isSponsor())
                            <x-nav-link :href="route('sponsor.dashboard')" :active="request()->routeIs('sponsor.*')">
                                Sponsorships
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right side -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                @auth
                    <!-- Notification Bell -->
                    <a href="{{ route('notifications.index') }}" class="relative text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-2.405A2.032 2.032 0 0118 13.516V10a6 6 0 10-12 0v3.516c0 .394-.143.765-.405 1.079L4 17h5m6 0a3 3 0 11-6 0" />
                        </svg>
                        @php $unread = auth()->user()->notifications()->where('read_status', false)->count(); @endphp
                        @if($unread > 0)
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">
                                {{ $unread > 9 ? '9+' : $unread }}
                            </span>
                        @endif
                    </a>

                    <!-- User Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">Log in</a>
                    <a href="{{ route('register') }}" class="text-sm bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Sign Up</a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')">
                Browse Events
            </x-responsive-nav-link>

            @auth
                @if(auth()->user()->isUser())
                    <x-responsive-nav-link :href="route('member.registrations')" :active="request()->routeIs('member.*')">
                        My Registrations
                    </x-responsive-nav-link>
                @endif

                @if(auth()->user()->isOrganizer())
                    <x-responsive-nav-link :href="route('organizer.dashboard')" :active="request()->routeIs('organizer.*')">
                        My Events
                    </x-responsive-nav-link>
                @endif

                @if(auth()->user()->isAdmin())
                    <x-responsive-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.*')">
                        Admin
                    </x-responsive-nav-link>
                @endif

                @if(auth()->user()->isVolunteer())
                    <x-responsive-nav-link :href="route('volunteer.tasks.index')" :active="request()->routeIs('volunteer.*')">
                        My Tasks
                    </x-responsive-nav-link>
                @endif

                @if(auth()->user()->isSponsor())
                    <x-responsive-nav-link :href="route('sponsor.dashboard')" :active="request()->routeIs('sponsor.*')">
                        Sponsorships
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        @auth
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('notifications.index')">Notifications</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @else
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('login')">Log in</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">Register</x-responsive-nav-link>
            </div>
        </div>
        @endauth
    </div>
</nav>

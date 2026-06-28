<x-app-layout>

<style>
@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(3deg); }
    50% { transform: translateY(-12px) rotate(3deg); }
}
@keyframes float2 {
    0%, 100% { transform: translateY(0px) rotate(-2deg); }
    50% { transform: translateY(-8px) rotate(-2deg); }
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}
.animate-float  { animation: float  5s ease-in-out infinite; }
.animate-float2 { animation: float2 6s ease-in-out infinite 1s; }
.fade-in-up { animation: fadeInUp 0.7s ease both; }
.fade-in-up-2 { animation: fadeInUp 0.7s ease 0.15s both; }
.fade-in-up-3 { animation: fadeInUp 0.7s ease 0.3s both; }
</style>

{{-- ═══════════════════════════════════════
     HERO
═══════════════════════════════════════ --}}
<section class="relative bg-gradient-to-br from-slate-900 via-green-950 to-slate-900 text-white overflow-hidden">

    {{-- Decorative circles --}}
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-green-500 rounded-full opacity-5 -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-blue-500 rounded-full opacity-5 translate-y-1/2 -translate-x-1/3 pointer-events-none"></div>

    {{-- Dot grid --}}
    <div class="absolute inset-0 pointer-events-none" style="background-image: radial-gradient(circle, rgba(255,255,255,0.06) 1px, transparent 1px); background-size: 32px 32px;"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Left: Copy --}}
            <div class="fade-in-up">
                <span class="inline-flex items-center gap-2 bg-green-500/15 border border-green-500/30 text-green-300 text-xs font-semibold px-4 py-1.5 rounded-full mb-6 tracking-widest uppercase">
                    <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span>
                    Community Event Platform
                </span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.1] tracking-tight">
                    Where Communities<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-300">Come Together</span>
                </h1>
                <p class="mt-6 text-slate-300 text-lg leading-relaxed max-w-lg">
                    Plan, promote, and participate in local events. Connect with organizers, volunteers, and sponsors — all in one trusted platform.
                </p>

                <div class="mt-10 flex flex-col sm:flex-row gap-4">
                    @guest
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center justify-center gap-2 bg-green-500 hover:bg-green-400 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-200 shadow-lg shadow-green-900/40 hover:shadow-green-500/30 hover:-translate-y-0.5">
                            Get Started — It's Free
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @endguest
                    <a href="{{ route('events.index') }}"
                       class="inline-flex items-center justify-center gap-2 border border-white/20 text-white hover:bg-white/10 px-8 py-4 rounded-xl font-semibold transition-all duration-200 hover:-translate-y-0.5">
                        Browse Events
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </a>
                </div>

                {{-- Social proof --}}
                <div class="mt-10 flex items-center gap-4">
                    <div class="flex -space-x-2">
                        @foreach([['S','bg-green-500'],['M','bg-blue-500'],['J','bg-purple-500'],['A','bg-orange-500'],['R','bg-pink-500']] as [$l,$c])
                            <div class="w-9 h-9 {{ $c }} rounded-full border-2 border-slate-900 flex items-center justify-center text-white text-xs font-bold">{{ $l }}</div>
                        @endforeach
                    </div>
                    <div>
                        <p class="text-white text-sm font-semibold">10,000+ members</p>
                        <p class="text-slate-400 text-xs">joined this year</p>
                    </div>
                </div>
            </div>

            {{-- Right: Visual --}}
            <div class="relative hidden lg:flex items-center justify-center fade-in-up-2">

                {{-- Community avatar grid --}}
                <div class="grid grid-cols-5 gap-3 opacity-50 absolute inset-0 items-center justify-items-center">
                    @php
                        $avatarData = [
                            ['K','bg-green-500'],['T','bg-blue-600'],['A','bg-purple-500'],['M','bg-rose-500'],['J','bg-amber-500'],
                            ['S','bg-teal-500'],['R','bg-indigo-500'],['L','bg-pink-500'],['D','bg-orange-500'],['N','bg-cyan-500'],
                            ['E','bg-green-600'],['B','bg-blue-500'],['C','bg-violet-500'],['H','bg-red-500'],['F','bg-lime-600'],
                            ['P','bg-sky-500'],['W','bg-emerald-500'],['Y','bg-fuchsia-500'],['Z','bg-yellow-500'],['Q','bg-green-400'],
                        ];
                    @endphp
                    @foreach($avatarData as [$l, $c])
                        <div class="w-10 h-10 {{ $c }} rounded-full flex items-center justify-center text-white text-xs font-bold shadow-lg">{{ $l }}</div>
                    @endforeach
                </div>

                {{-- Floating event card --}}
                <div class="animate-float relative z-10 bg-white rounded-2xl shadow-2xl p-4 w-64 border border-gray-100">
                    <div class="h-28 bg-gradient-to-br from-green-400 to-emerald-600 rounded-xl mb-3 flex items-center justify-center text-4xl">🎉</div>
                    <h4 class="font-bold text-gray-900 text-sm">Summer Community Festival</h4>
                    <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Central Park · Jul 15
                    </p>
                    <div class="mt-3 flex items-center justify-between">
                        <div class="flex -space-x-1">
                            @foreach([['A','bg-green-500'],['B','bg-blue-500'],['C','bg-purple-500']] as [$l,$c])
                                <div class="w-6 h-6 {{ $c }} rounded-full border border-white flex items-center justify-center text-white text-xs font-bold">{{ $l }}</div>
                            @endforeach
                            <div class="w-6 h-6 bg-gray-200 rounded-full border border-white flex items-center justify-center text-gray-600 text-xs font-bold">+8</div>
                        </div>
                        <span class="text-xs text-green-600 font-semibold bg-green-50 px-2 py-1 rounded-full">48 going</span>
                    </div>
                </div>

                {{-- Floating notification --}}
                <div class="animate-float2 absolute top-4 -right-4 z-20 bg-white rounded-xl shadow-xl p-3 flex items-center gap-3 w-52 border border-gray-100">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center shrink-0 text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-900">Registration confirmed!</p>
                        <p class="text-xs text-gray-400">Beach Cleanup · 2m ago</p>
                    </div>
                </div>

                {{-- Volunteer badge --}}
                <div class="animate-float absolute -bottom-2 -left-6 z-20 bg-white rounded-xl shadow-xl p-3 flex items-center gap-3 border border-gray-100">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center shrink-0 text-blue-600">🤝</div>
                    <div>
                        <p class="text-xs font-semibold text-gray-900">12 volunteers joined</p>
                        <p class="text-xs text-gray-400">Food Drive 2026</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Wave --}}
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
        <svg viewBox="0 0 1440 56" preserveAspectRatio="none" class="w-full h-10 sm:h-14" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,28 C480,56 960,0 1440,28 L1440,56 L0,56 Z" fill="white"/>
        </svg>
    </div>
</section>

{{-- ═══════════════════════════════════════
     TRUST / STATS BAR
═══════════════════════════════════════ --}}
<section class="bg-white py-12 border-b border-gray-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-center text-xs text-gray-400 uppercase tracking-widest font-semibold mb-8">Trusted by communities across the country</p>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 text-center">
            @foreach([
                ['1,250+', 'Events Hosted', '📅'],
                ['35,000+', 'Participants', '👥'],
                ['8,500+', 'Volunteers', '🤝'],
                ['120+', 'Communities', '🏘️'],
            ] as [$val, $label, $icon])
                <div class="group">
                    <div class="text-3xl mb-1">{{ $icon }}</div>
                    <p class="text-3xl font-extrabold text-gray-900">{{ $val }}</p>
                    <p class="text-sm text-gray-500 mt-1">{{ $label }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     FEATURES
═══════════════════════════════════════ --}}
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="text-green-600 text-sm font-semibold uppercase tracking-widest">Everything you need</span>
            <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold text-gray-900">One platform, every role covered</h2>
            <p class="mt-4 text-gray-500 max-w-xl mx-auto text-lg">From planning to participation, CommunityConnect gives every stakeholder the tools they need to make events succeed.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
                    'color' => 'bg-green-50 text-green-600',
                    'title' => 'Create & Manage Events',
                    'desc'  => 'Organizers can create events with rich details, manage registrations, and track attendance all in one place.',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>',
                    'color' => 'bg-blue-50 text-blue-600',
                    'title' => 'Volunteer Coordination',
                    'desc'  => 'Assign tasks, track availability, and manage volunteer sign-ups with slot controls and schedule views.',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                    'color' => 'bg-emerald-50 text-emerald-600',
                    'title' => 'Easy Registration',
                    'desc'  => 'Members register in one click, receive confirmation notifications, and manage all their upcoming events.',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>',
                    'color' => 'bg-yellow-50 text-yellow-600',
                    'title' => 'Feedback & Ratings',
                    'desc'  => 'Collect post-event feedback with star ratings and comments. Organizers get actionable insights to improve.',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                    'color' => 'bg-orange-50 text-orange-600',
                    'title' => 'Sponsorship Tracking',
                    'desc'  => 'Sponsors submit contributions, receive digital acknowledgments, and view impact reports with real metrics.',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>',
                    'color' => 'bg-purple-50 text-purple-600',
                    'title' => 'Admin Dashboard',
                    'desc'  => 'Full admin control — approve events, manage users, block accounts, and view a complete audit log.',
                ],
            ] as $feature)
                <div class="group bg-white border border-gray-100 rounded-2xl p-6 hover:shadow-lg hover:border-green-200 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 {{ $feature['color'] }} rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">{!! $feature['icon'] !!}</svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">{{ $feature['title'] }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">{{ $feature['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     UPCOMING EVENTS
═══════════════════════════════════════ --}}
<section class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-10">
            <div>
                <span class="text-green-600 text-sm font-semibold uppercase tracking-widest">Happening soon</span>
                <h2 class="mt-1 text-3xl font-extrabold text-gray-900">Upcoming Events</h2>
                <p class="text-gray-500 mt-2">Discover exciting events happening in your community</p>
            </div>
            <a href="{{ route('events.index') }}" class="hidden sm:flex items-center gap-1 text-sm font-semibold text-green-600 hover:text-green-700 transition">
                View all events
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @if($featured->isEmpty())
            <div class="text-center py-16 bg-white rounded-2xl border border-gray-100">
                <div class="text-5xl mb-4">📅</div>
                <p class="text-gray-500 font-medium">No upcoming events yet — check back soon!</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featured as $event)
                    @php
                        $gradients = ['from-green-500 to-emerald-700','from-blue-500 to-indigo-700','from-purple-500 to-violet-700','from-orange-500 to-rose-600','from-teal-500 to-cyan-700'];
                        $gradient  = $gradients[$event->id % count($gradients)];
                    @endphp
                    <a href="{{ route('events.show', $event) }}"
                       class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col border border-gray-100 hover:-translate-y-1">
                        <div class="h-48 relative overflow-hidden">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br {{ $gradient }} group-hover:scale-105 transition-transform duration-500"></div>
                            @endif
                            @if($event->category)
                                <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-gray-700 text-xs font-semibold px-2.5 py-1 rounded-full shadow-sm">{{ $event->category }}</span>
                            @endif
                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-gray-800 text-center px-2.5 py-1.5 rounded-xl shadow-sm min-w-[44px]">
                                <div class="text-base font-extrabold leading-none">{{ $event->date->format('j') }}</div>
                                <div class="text-xs uppercase tracking-wide">{{ $event->date->format('M') }}</div>
                            </div>
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="font-bold text-gray-900 group-hover:text-green-700 transition line-clamp-1">{{ $event->title }}</h3>
                            <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span class="truncate">{{ $event->location }}</span>
                            </p>
                            <p class="text-sm text-gray-500 mt-2 line-clamp-2 flex-1">{{ $event->description }}</p>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold text-xs">{{ strtoupper(substr($event->organizer->name, 0, 1)) }}</div>
                                    <span class="text-xs text-gray-400">{{ $event->organizer->name }}</span>
                                </div>
                                <span class="text-xs font-semibold text-green-600 group-hover:underline">Register →</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

        <div class="text-center mt-10 sm:hidden">
            <a href="{{ route('events.index') }}" class="inline-block border border-gray-200 text-gray-600 hover:border-green-500 hover:text-green-600 px-6 py-2.5 rounded-full text-sm font-medium transition">View All Events</a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     HOW IT WORKS
═══════════════════════════════════════ --}}
<section class="bg-white py-20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="text-green-600 text-sm font-semibold uppercase tracking-widest">Simple process</span>
            <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold text-gray-900">Get started in 3 steps</h2>
            <p class="mt-4 text-gray-500 text-lg">Getting involved in your community has never been easier.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
            @foreach([
                ['01', 'Create Your Account', 'Sign up in under a minute. Choose your role — member, organizer, volunteer, or sponsor — and get immediate access to all features.', '🚀', 'bg-green-50 border-green-200'],
                ['02', 'Discover Events',      'Browse a rich catalog of community events. Filter by category, date, or location. Every event has full details and volunteer opportunities.', '🔍', 'bg-blue-50 border-blue-200'],
                ['03', 'Participate & Grow',   'Register for events, sign up to volunteer, or sponsor a cause you care about. Track everything from your personal dashboard.', '🌱', 'bg-emerald-50 border-emerald-200'],
            ] as [$step, $title, $desc, $emoji, $bg])
                <div class="relative border {{ $bg }} rounded-2xl p-6 text-center hover:shadow-md transition-all duration-300">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-white border border-gray-200 text-green-700 text-xs font-extrabold w-8 h-8 rounded-full flex items-center justify-center shadow-sm">{{ $step }}</div>
                    <div class="text-4xl mt-4 mb-4">{{ $emoji }}</div>
                    <h3 class="font-bold text-gray-900 mb-2">{{ $title }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">{{ $desc }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     ANIMATED STATS COUNTER
═══════════════════════════════════════ --}}
<section class="bg-gradient-to-br from-green-700 to-emerald-800 text-white py-20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl font-extrabold mb-4">Making a real impact</h2>
        <p class="text-green-200 text-lg mb-14 max-w-xl mx-auto">Every event creates connections. Every volunteer makes a difference. Every sponsor fuels the mission.</p>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-8"
             x-data="{
                 counts: {events: 0, people: 0, volunteers: 0, sponsors: 0},
                 targets: {events: 1250, people: 35000, volunteers: 8500, sponsors: 340},
                 started: false,
                 start() {
                     if (this.started) return; this.started = true;
                     const keys = Object.keys(this.targets);
                     keys.forEach(k => {
                         const target = this.targets[k];
                         const step = Math.ceil(target / 60);
                         const timer = setInterval(() => {
                             this.counts[k] = Math.min(this.counts[k] + step, target);
                             if (this.counts[k] >= target) clearInterval(timer);
                         }, 30);
                     });
                 }
             }"
             x-intersect="start()">
            @foreach([
                ['events',    'Events Hosted',   '+'],
                ['people',    'People Connected', '+'],
                ['volunteers','Volunteers',       '+'],
                ['sponsors',  'Sponsors',         '+'],
            ] as [$key, $label, $suffix])
                <div>
                    <p class="text-4xl sm:text-5xl font-extrabold" x-text="counts.{{ $key }}.toLocaleString() + '{{ $suffix }}'"></p>
                    <p class="text-green-200 text-sm mt-2 uppercase tracking-wide">{{ $label }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     TESTIMONIALS
═══════════════════════════════════════ --}}
<section class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="text-green-600 text-sm font-semibold uppercase tracking-widest">What people say</span>
            <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold text-gray-900">Loved by communities</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            @foreach([
                ['Sarah M.', 'Community Member', 'S', 'bg-green-500', 'CommunityConnect made it so easy to find meaningful events in my neighborhood. I discovered a food drive, signed up in seconds, and met incredible people. This platform is a game changer!', 5],
                ['James K.', 'Event Organizer', 'J', 'bg-blue-500', 'As an organizer, the tools here save me hours every week. Managing volunteers, tracking registrations, viewing feedback — it\'s all in one clean dashboard. Couldn\'t run my events without it.', 5],
                ['Lisa T.', 'Volunteer', 'L', 'bg-purple-500', 'I love that I can browse open volunteer tasks and sign up with one click. The schedule view keeps me organized and I always know exactly where I need to be. Highly recommended!', 5],
            ] as [$name, $role, $initial, $color, $quote, $stars])
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 flex flex-col">
                    <div class="flex text-yellow-400 mb-4">
                        @for($i = 0; $i < $stars; $i++) <span>★</span> @endfor
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed flex-1">"{{ $quote }}"</p>
                    <div class="mt-6 flex items-center gap-3">
                        <div class="w-10 h-10 {{ $color }} rounded-full flex items-center justify-center text-white font-bold text-sm shrink-0">{{ $initial }}</div>
                        <div>
                            <p class="font-semibold text-gray-900 text-sm">{{ $name }}</p>
                            <p class="text-xs text-gray-400">{{ $role }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     JOIN US / ROLES
═══════════════════════════════════════ --}}
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="text-green-600 text-sm font-semibold uppercase tracking-widest">Find your role</span>
            <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold text-gray-900">There's a place for everyone</h2>
            <p class="mt-4 text-gray-500 text-lg max-w-xl mx-auto">Whether you want to attend, organize, volunteer, or sponsor — CommunityConnect has you covered.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach([
                ['📅', 'Organizer', 'bg-green-600', 'border-green-200', 'hover:border-green-400', 'Create events, manage attendees, add volunteer tasks, and view feedback reports.'],
                ['🙋', 'Member', 'bg-blue-600', 'border-blue-200', 'hover:border-blue-400', 'Browse events, register in one click, submit feedback, and track your history.'],
                ['🤝', 'Volunteer', 'bg-purple-600', 'border-purple-200', 'hover:border-purple-400', 'Sign up for volunteer tasks, manage your schedule, and update your availability.'],
                ['💼', 'Sponsor', 'bg-orange-600', 'border-orange-200', 'hover:border-orange-400', 'Submit sponsorships, receive digital acknowledgment certificates, and view impact reports.'],
            ] as [$emoji, $role, $btnColor, $border, $hoverBorder, $desc])
                <div class="border {{ $border }} {{ $hoverBorder }} rounded-2xl p-6 text-center transition-all duration-300 hover:shadow-md hover:-translate-y-1 group">
                    <div class="text-4xl mb-3">{{ $emoji }}</div>
                    <h3 class="font-bold text-gray-900 mb-2">{{ $role }}</h3>
                    <p class="text-sm text-gray-500 mb-5 leading-relaxed">{{ $desc }}</p>
                    <a href="{{ route('register') }}"
                       class="{{ $btnColor }} hover:opacity-90 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition inline-block">
                        Join as {{ $role }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     SPONSOR SHOWCASE
═══════════════════════════════════════ --}}
<section class="bg-gray-50 py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-xs text-gray-400 uppercase tracking-widest font-semibold mb-8">Organizations that trust CommunityConnect</p>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach(['GreenLeaf Co.', 'BlueSky Corp.', 'Unity Bank', 'FreshStart', 'CivicBridge', 'PeoplePlus'] as $sponsor)
                <div class="bg-white border border-gray-100 rounded-xl py-4 px-3 flex items-center justify-center hover:shadow-sm hover:border-green-200 transition cursor-default">
                    <span class="text-xs font-bold text-gray-500 text-center leading-tight">{{ $sponsor }}</span>
                </div>
            @endforeach
        </div>
        <p class="mt-8 text-sm text-gray-400">
            Want to sponsor community events?
            <a href="{{ route('register') }}" class="text-green-600 hover:underline font-semibold">Become a sponsor →</a>
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════
     FAQ
═══════════════════════════════════════ --}}
<section class="bg-white py-20">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-green-600 text-sm font-semibold uppercase tracking-widest">FAQ</span>
            <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold text-gray-900">Frequently asked questions</h2>
        </div>

        <div class="space-y-3" x-data="{ open: null }">
            @foreach([
                ['How do I create an account?', 'Click "Get Started" and fill in your name, email, and password. You\'ll also choose your role (member, organizer, volunteer, or sponsor) during sign-up. Admin accounts must be created by an existing admin.'],
                ['Is it free to join?', 'Yes! Creating an account and participating in events is completely free for members and volunteers. Organizers and sponsors may discuss contribution arrangements directly with event organizers.'],
                ['How does event approval work?', 'When an organizer creates an event, it\'s submitted as "pending." Our admin team reviews and approves events before they go live in the public catalog, ensuring quality and community standards.'],
                ['Can I volunteer for multiple events?', 'Absolutely. Volunteers can sign up for tasks across as many events as they like, as long as slots are available. Your personal schedule view keeps all your assignments organized in one place.'],
                ['How are sponsors acknowledged?', 'Once an organizer or admin marks your sponsorship as acknowledged, you\'ll receive a digital acknowledgment certificate viewable on the platform. You can also view an impact report showing attendance and feedback metrics.'],
                ['Can I cancel my registration?', 'Yes. You can cancel a confirmed registration any time from the event detail page or your "My Registrations" dashboard — as long as the event hasn\'t already passed.'],
            ] as $i => [$q, $a])
                <div class="border border-gray-100 rounded-2xl overflow-hidden hover:border-green-200 transition"
                     x-data="{ id: {{ $i }} }">
                    <button class="w-full flex items-center justify-between px-6 py-5 text-left"
                            @click="open = open === id ? null : id">
                        <span class="font-semibold text-gray-900 pr-4">{{ $q }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-5 w-5 text-green-500 shrink-0 transition-transform duration-200"
                             :class="open === id ? 'rotate-180' : ''"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === id"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="px-6 pb-5 text-sm text-gray-500 leading-relaxed border-t border-gray-50 pt-4">
                        {{ $a }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     CTA BANNER
═══════════════════════════════════════ --}}
<section class="bg-gradient-to-r from-green-700 to-emerald-600 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h2 class="text-3xl sm:text-4xl font-extrabold mb-4">Ready to strengthen your community?</h2>
        <p class="text-green-100 text-lg mb-8 max-w-xl mx-auto">Join thousands of members, organizers, volunteers, and sponsors who are already making a difference.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @guest
                <a href="{{ route('register') }}"
                   class="inline-block bg-white text-green-700 hover:bg-green-50 font-bold px-8 py-4 rounded-xl transition shadow-lg hover:-translate-y-0.5">
                    Create Free Account
                </a>
            @endguest
            <a href="{{ route('events.index') }}"
               class="inline-block border-2 border-white/60 text-white hover:bg-white/10 font-semibold px-8 py-4 rounded-xl transition hover:-translate-y-0.5">
                Browse Events
            </a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     FOOTER
═══════════════════════════════════════ --}}
<footer class="bg-slate-900 text-slate-400">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-10 mb-12">

            {{-- Brand --}}
            <div class="lg:col-span-2">
                <div class="flex items-center gap-2.5 mb-4">
                    <x-application-logo class="w-9 h-9" />
                    <span class="text-white font-extrabold text-lg">{{ config('app.name') }}</span>
                </div>
                <p class="text-sm leading-relaxed max-w-xs">Making community event planning simple, transparent, and inclusive — for everyone, everywhere.</p>
                {{-- Social --}}
                <div class="mt-5 flex gap-3">
                    @foreach([
                        ['Twitter', '<path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/>'],
                        ['Facebook', '<path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>'],
                        ['Instagram', '<rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>'],
                    ] as [$name, $path])
                        <a href="#" aria-label="{{ $name }}" class="w-8 h-8 bg-slate-800 hover:bg-green-600 rounded-lg flex items-center justify-center transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">{!! $path !!}</svg>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Platform --}}
            <div>
                <h4 class="text-white font-semibold text-sm mb-4">Platform</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('events.index') }}" class="hover:text-white transition">Browse Events</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-white transition">Become an Organizer</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-white transition">Volunteer</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-white transition">Sponsor Events</a></li>
                </ul>
            </div>

            {{-- Resources --}}
            <div>
                <h4 class="text-white font-semibold text-sm mb-4">Resources</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                    <li><a href="#" class="hover:text-white transition">Community Guidelines</a></li>
                    <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                </ul>
            </div>

            {{-- Newsletter --}}
            <div>
                <h4 class="text-white font-semibold text-sm mb-4">Stay in the loop</h4>
                <p class="text-sm mb-3">Get updates on new events and platform news.</p>
                <div class="flex gap-2">
                    <input type="email" placeholder="you@email.com"
                           class="flex-1 text-xs bg-slate-800 border border-slate-700 rounded-lg px-3 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:border-green-500 transition">
                    <button class="bg-green-600 hover:bg-green-500 text-white text-xs px-3 py-2.5 rounded-lg transition font-semibold">Go</button>
                </div>
            </div>
        </div>

        <div class="border-t border-slate-800 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <div class="flex gap-4">
                <a href="#" class="hover:text-white transition">Privacy</a>
                <a href="#" class="hover:text-white transition">Terms</a>
                <a href="#" class="hover:text-white transition">Cookies</a>
            </div>
        </div>
    </div>
</footer>

</x-app-layout>

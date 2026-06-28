<x-app-layout>
    <!-- Hero -->
    <div class="relative bg-gradient-to-br from-green-800 via-green-700 to-green-900 text-white overflow-hidden">
        <!-- Background pattern -->
        <div class="absolute inset-0 opacity-10">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)"/>
            </svg>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
            <span class="inline-block bg-green-500/30 border border-green-400/40 text-green-100 text-xs font-semibold px-4 py-1.5 rounded-full mb-6 tracking-wide uppercase">
                Community Event Platform
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight">
                Bringing Communities<br class="hidden sm:block"> Together Through Events
            </h1>
            <p class="mt-6 text-green-200 text-lg max-w-2xl mx-auto">
                Plan, promote, and participate in local community events. Connect with organizers, volunteers, and sponsors all in one place.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                @guest
                    <a href="{{ route('register') }}"
                       class="inline-block bg-orange-500 hover:bg-orange-400 text-white px-8 py-3.5 rounded-full font-semibold transition shadow-lg shadow-orange-900/30">
                        Get Started Free
                    </a>
                @endguest
                <a href="{{ route('events.index') }}"
                   class="inline-block border-2 border-white/60 text-white hover:bg-white hover:text-green-800 px-8 py-3.5 rounded-full font-semibold transition">
                    Explore Events
                </a>
            </div>
        </div>

        <!-- Wave bottom -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
            <svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-12 sm:h-16" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,40 C360,80 1080,0 1440,40 L1440,60 L0,60 Z" fill="#f9fafb"/>
            </svg>
        </div>
    </div>

    <!-- Stats Bar -->
    <div class="bg-gray-50 pt-6 pb-2">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 grid grid-cols-2 sm:grid-cols-4 divide-x divide-y sm:divide-y-0 divide-gray-100">
                @foreach([
                    ['value' => $stats['events'],      'label' => 'Events Hosted',  'suffix' => '+'],
                    ['value' => $stats['participants'], 'label' => 'Participants',   'suffix' => '+'],
                    ['value' => $stats['volunteers'],  'label' => 'Volunteers',     'suffix' => '+'],
                    ['value' => $stats['members'],     'label' => 'Members',        'suffix' => '+'],
                ] as $stat)
                    <div class="py-6 text-center">
                        <p class="text-3xl font-bold text-green-700">{{ $stat['value'] > 0 ? number_format($stat['value']) . $stat['suffix'] : '—' }}</p>
                        <p class="text-xs text-gray-500 mt-1 uppercase tracking-wide">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- How it works -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-gray-900">How It Works</h2>
                <p class="text-gray-500 mt-2">Getting involved takes just three steps</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 relative">
                <!-- Connector line (desktop only) -->
                <div class="hidden sm:block absolute top-8 left-1/6 right-1/6 h-0.5 bg-green-100 z-0"></div>

                @foreach([
                    ['step' => '1', 'title' => 'Create an Account', 'desc' => 'Sign up as a member, organizer, volunteer, or sponsor — each role has its own set of features.'],
                    ['step' => '2', 'title' => 'Find an Event',      'desc' => 'Browse upcoming community events, filter by category, and read all the details before committing.'],
                    ['step' => '3', 'title' => 'Join or Contribute', 'desc' => 'Register as an attendee, sign up to volunteer, or sponsor an event that matters to you.'],
                ] as $item)
                    <div class="relative z-10 text-center">
                        <div class="w-16 h-16 bg-green-600 text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4 shadow-lg shadow-green-200">
                            {{ $item['step'] }}
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">{{ $item['title'] }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Upcoming Events -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-10">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Upcoming Events</h2>
                    <p class="text-gray-500 mt-1">Discover exciting events happening in your community</p>
                </div>
                <a href="{{ route('events.index') }}"
                   class="text-sm font-medium text-green-600 hover:text-green-700 transition hidden sm:block">
                    View all →
                </a>
            </div>

            @if($featured->isEmpty())
                <p class="text-center text-gray-400 py-10">No upcoming events yet. Check back soon!</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($featured as $event)
                        @php
                            $gradients = [
                                'from-green-600 to-green-900',
                                'from-blue-600 to-blue-900',
                                'from-purple-600 to-purple-900',
                                'from-orange-500 to-orange-800',
                                'from-teal-600 to-teal-900',
                            ];
                            $gradient = $gradients[$event->id % count($gradients)];
                        @endphp
                        <a href="{{ route('events.show', $event) }}"
                           class="group bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col border border-gray-100">
                            <!-- Image -->
                            <div class="h-48 relative overflow-hidden">
                                @if($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}"
                                         alt="{{ $event->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br {{ $gradient }} group-hover:scale-105 transition-transform duration-500"></div>
                                @endif
                                <!-- Category badge -->
                                @if($event->category)
                                    <span class="absolute top-3 left-3 bg-white/90 text-gray-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                                        {{ $event->category }}
                                    </span>
                                @endif
                                <!-- Date badge -->
                                <div class="absolute top-3 right-3 bg-white/90 text-gray-800 text-center px-2.5 py-1 rounded-xl min-w-[44px]">
                                    <div class="text-lg font-extrabold leading-none">{{ $event->date->format('j') }}</div>
                                    <div class="text-xs uppercase tracking-wide">{{ $event->date->format('M') }}</div>
                                </div>
                            </div>
                            <!-- Body -->
                            <div class="p-5 flex flex-col flex-1">
                                <h3 class="font-semibold text-gray-900 group-hover:text-green-700 transition line-clamp-1">{{ $event->title }}</h3>
                                <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="truncate">{{ $event->location }}</span>
                                </p>
                                <p class="text-sm text-gray-500 mt-2 line-clamp-2 flex-1">{{ $event->description }}</p>
                                <!-- Organizer -->
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold text-xs shrink-0">
                                            {{ strtoupper(substr($event->organizer->name, 0, 1)) }}
                                        </div>
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
                <a href="{{ route('events.index') }}"
                   class="inline-block border border-gray-200 text-gray-600 hover:border-green-500 hover:text-green-600 px-6 py-2.5 rounded-full text-sm font-medium transition">
                    View All Events
                </a>
            </div>
        </div>
    </div>

    <!-- Join Our Community -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-900">Join Our Community</h2>
                <p class="text-gray-500 mt-2">Whether you're organizing, volunteering, or sponsoring, there's a place for you</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-4xl mx-auto">
                <div class="bg-white border border-green-100 rounded-2xl p-6 text-center hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                    <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-3xl">📅</div>
                    <h3 class="font-bold text-gray-900">Event Organizer</h3>
                    <p class="text-sm text-gray-500 mt-2 mb-5">Create and manage community events with ease.</p>
                    <a href="{{ route('register') }}"
                       class="inline-block bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-5 py-2 rounded-lg transition">
                        Get Started
                    </a>
                </div>
                <div class="bg-white border border-blue-100 rounded-2xl p-6 text-center hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-3xl">🤝</div>
                    <h3 class="font-bold text-gray-900">Volunteer</h3>
                    <p class="text-sm text-gray-500 mt-2 mb-5">Find meaningful opportunities to give back to your community.</p>
                    <a href="{{ route('register') }}"
                       class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2 rounded-lg transition">
                        Join Now
                    </a>
                </div>
                <div class="bg-white border border-orange-100 rounded-2xl p-6 text-center hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                    <div class="w-14 h-14 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-3xl">💼</div>
                    <h3 class="font-bold text-gray-900">Sponsor</h3>
                    <p class="text-sm text-gray-500 mt-2 mb-5">Support community initiatives and gain valuable visibility.</p>
                    <a href="{{ route('register') }}"
                       class="inline-block bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-5 py-2 rounded-lg transition">
                        Support Us
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 sm:grid-cols-4 gap-8">
            <div class="sm:col-span-1">
                <div class="flex items-center gap-2 mb-3">
                    <x-application-logo class="w-8 h-8" />
                    <span class="text-white font-bold text-sm">{{ config('app.name') }}</span>
                </div>
                <p class="text-xs leading-relaxed">Making community event planning simple, effective, and inclusive for all.</p>
            </div>
            <div>
                <h4 class="text-white font-semibold text-sm mb-3">Quick Links</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="{{ route('events.index') }}" class="hover:text-white transition">Events</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-white transition">Volunteer</a></li>
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">About Us</a></li>
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold text-sm mb-3">Resources</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="#" class="hover:text-white transition">Help / FAQ</a></li>
                    <li><a href="#" class="hover:text-white transition">Support</a></li>
                    <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold text-sm mb-3">Newsletter</h4>
                <p class="text-xs mb-3">Subscribe to get event updates and upcoming events.</p>
                <div class="flex gap-2">
                    <input type="email" placeholder="Your email"
                           class="flex-1 text-xs bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-white placeholder-gray-500 focus:outline-none focus:border-green-500">
                    <button class="bg-green-600 hover:bg-green-700 text-white text-xs px-3 py-2 rounded-lg transition">Go</button>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-800 text-center text-xs py-4">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </footer>
</x-app-layout>

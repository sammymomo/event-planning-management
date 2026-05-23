<x-app-layout>
    <!-- Hero -->
    <div class="bg-green-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <h1 class="text-4xl sm:text-5xl font-bold leading-tight">
                Bringing Communities Together<br class="hidden sm:block"> Through Events
            </h1>
            <p class="mt-5 text-green-200 text-lg max-w-xl mx-auto">
                Plan, promote, and participate in local community events with our all-in-one platform.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                @guest
                    <a href="{{ route('register') }}"
                       class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-full font-semibold transition">
                        Get Started
                    </a>
                @endguest
                <a href="{{ route('events.index') }}"
                   class="inline-block border-2 border-white text-white hover:bg-white hover:text-green-800 px-8 py-3 rounded-full font-semibold transition">
                    Explore Events
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Bar -->
    <div class="bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 grid grid-cols-2 sm:grid-cols-4 gap-6 text-center">
            <div>
                <p class="text-2xl font-bold text-gray-900">1,250+</p>
                <p class="text-sm text-gray-500 mt-0.5">Events Hosted</p>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">35K+</p>
                <p class="text-sm text-gray-500 mt-0.5">Participants</p>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">8,500+</p>
                <p class="text-sm text-gray-500 mt-0.5">Volunteers</p>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">120+</p>
                <p class="text-sm text-gray-500 mt-0.5">Communities</p>
            </div>
        </div>
    </div>

    <!-- Upcoming Events -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-900">Upcoming Community Events</h2>
                <p class="text-gray-500 mt-2">Discover exciting events happening in your community</p>
            </div>

            @php
                $featured = \App\Models\Event::with('organizer')
                    ->where('status', \App\Enums\EventStatus::Approved)
                    ->where('date', '>=', now()->toDateString())
                    ->orderBy('date')
                    ->take(3)
                    ->get();
            @endphp

            @if($featured->isEmpty())
                <p class="text-center text-gray-400 py-10">No upcoming events yet. Check back soon!</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($featured as $event)
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden flex flex-col">
                            <!-- Placeholder image -->
                            <div class="h-40 bg-gradient-to-br from-green-600 to-green-900 relative">
                                <span class="absolute top-3 left-3 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full uppercase tracking-wide">
                                    Upcoming
                                </span>
                                <span class="absolute top-3 right-3 bg-white text-green-700 text-xs font-bold px-2 py-1 rounded-full">
                                    {{ $event->date->format('M j') }}
                                </span>
                            </div>
                            <div class="p-5 flex flex-col flex-1">
                                <h3 class="font-semibold text-gray-900">{{ $event->title }}</h3>
                                <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $event->location }}
                                </p>
                                <p class="text-sm text-gray-500 mt-2 line-clamp-2 flex-1">{{ $event->description }}</p>
                                <a href="{{ route('events.show', $event) }}"
                                   class="mt-4 block text-center bg-green-600 hover:bg-green-700 text-white text-sm font-semibold py-2 rounded-lg transition">
                                    Register Now
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="text-center mt-8">
                <a href="{{ route('events.index') }}"
                   class="inline-block border border-gray-300 text-gray-700 hover:border-green-500 hover:text-green-600 px-6 py-2.5 rounded-full text-sm font-medium transition">
                    View All Events
                </a>
            </div>
        </div>
    </div>

    <!-- Join Our Community -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-900">Join Our Community</h2>
                <p class="text-gray-500 mt-2">Whether you're organizing, volunteering, or sponsoring, there's a place for you</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-4xl mx-auto">
                <div class="border border-green-200 rounded-xl p-6 text-center hover:shadow-md transition">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-4 text-2xl">📅</div>
                    <h3 class="font-bold text-gray-900">Event Organizer</h3>
                    <p class="text-sm text-gray-500 mt-2 mb-4">Create and manage community events with ease for tons.</p>
                    <a href="{{ route('register') }}"
                       class="inline-block bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-5 py-2 rounded-lg transition">
                        Get Started
                    </a>
                </div>
                <div class="border border-blue-200 rounded-xl p-6 text-center hover:shadow-md transition">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-4 text-2xl">🤝</div>
                    <h3 class="font-bold text-gray-900">Volunteer</h3>
                    <p class="text-sm text-gray-500 mt-2 mb-4">Find meaningful opportunities to contribute to your community.</p>
                    <a href="{{ route('register') }}"
                       class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2 rounded-lg transition">
                        Join Now
                    </a>
                </div>
                <div class="border border-orange-200 rounded-xl p-6 text-center hover:shadow-md transition">
                    <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mx-auto mb-4 text-2xl">💼</div>
                    <h3 class="font-bold text-gray-900">Sponsor</h3>
                    <p class="text-sm text-gray-500 mt-2 mb-4">Support community initiatives and gain valuable visibility.</p>
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

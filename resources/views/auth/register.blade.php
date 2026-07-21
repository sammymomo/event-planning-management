<x-guest-layout>
    {{-- Green gradient header --}}
    <div class="bg-gradient-to-br from-green-700 to-emerald-800 px-8 py-8 text-center">
        <div class="flex justify-center mb-3">
            <x-application-logo class="w-10 h-10" />
        </div>
        <h1 class="text-2xl font-bold text-white">Create Your Account</h1>
        <p class="text-green-200 text-sm mt-1">Join thousands of community members today</p>
    </div>

    {{-- Form body --}}
    <div class="px-8 py-8">
        <form method="POST" action="{{ route('register') }}" class="space-y-5"
              x-data="{ role: '{{ old('role', '') }}' }">
            @csrf

            {{-- Role Selector --}}
            <div>
                <p class="text-sm font-medium text-gray-700 mb-3 text-center">I am joining as a:</p>
                <div class="grid grid-cols-4 gap-2">
                    @foreach([
                        ['value' => 'user',      'label' => 'Member',    'icon' => '🎟️'],
                        ['value' => 'organizer', 'label' => 'Organizer', 'icon' => '📅'],
                        ['value' => 'volunteer', 'label' => 'Volunteer', 'icon' => '🤝'],
                        ['value' => 'sponsor',   'label' => 'Sponsor',   'icon' => '💼'],
                    ] as $r)
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="{{ $r['value'] }}" x-model="role" class="sr-only" {{ old('role') === $r['value'] ? 'checked' : '' }}>
                            <div :class="role === '{{ $r['value'] }}' ? 'border-green-600 bg-green-50 text-green-700 shadow-sm' : 'border-gray-200 text-gray-500 hover:border-green-300 hover:bg-gray-50'"
                                 class="border-2 rounded-xl p-3 text-center transition-all duration-150">
                                <div class="text-xl mb-1">{{ $r['icon'] }}</div>
                                <div class="text-xs font-semibold">{{ $r['label'] }}</div>
                            </div>
                        </label>
                    @endforeach
                </div>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <div class="grid grid-cols-1 gap-5">
                <div>
                    <x-input-label for="name" :value="__('Full Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" placeholder="Your full name" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email Address')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" placeholder="you@example.com" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="phone" :value="__('Phone (optional)')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone"
                        :value="old('phone')" placeholder="+1 (555) 000-0000" autocomplete="tel" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password"
                        name="password" placeholder="Min. 8 characters" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" placeholder="••••••••" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-sm hover:shadow-md">
                Create Account
            </button>
        </form>

        <div class="mt-6 pt-6 border-t border-gray-100 text-center">
            <p class="text-sm text-gray-500">
                Already have an account?
                <a href="{{ route('login') }}" class="text-green-600 font-semibold hover:text-green-700">
                    Sign in →
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>

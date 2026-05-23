<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Create Account</h1>
        <p class="text-sm text-gray-500 mt-1">Join our community of organizers and volunteers</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4" x-data="{ role: '{{ old('role', '') }}' }">
        @csrf

        <!-- Role Selector -->
        <div>
            <p class="text-sm text-gray-600 text-center mb-3">I am joining as a:</p>
            <div class="grid grid-cols-4 gap-2">
                @foreach([
                    ['value' => 'user',      'label' => 'Member',    'icon' => '🎟️'],
                    ['value' => 'organizer', 'label' => 'Organizer', 'icon' => '📅'],
                    ['value' => 'volunteer', 'label' => 'Volunteer', 'icon' => '🤝'],
                    ['value' => 'sponsor',   'label' => 'Sponsor',   'icon' => '💼'],
                ] as $r)
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="{{ $r['value'] }}" x-model="role" class="sr-only" {{ old('role') === $r['value'] ? 'checked' : '' }}>
                        <div :class="role === '{{ $r['value'] }}' ? 'border-green-600 bg-green-50 text-green-700' : 'border-gray-200 text-gray-500 hover:border-green-400'"
                             class="border-2 rounded-xl p-3 text-center transition">
                            <div class="text-2xl mb-1">{{ $r['icon'] }}</div>
                            <div class="text-xs font-medium">{{ $r['label'] }}</div>
                        </div>
                    </label>
                @endforeach
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                :value="old('name')" placeholder="Your name" required autofocus autocomplete="name" />
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
                name="password" placeholder="••••••••" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" placeholder="••••••••" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button>Continue</x-primary-button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-5">
        Already have an account?
        <a href="{{ route('login') }}" class="text-green-600 font-semibold hover:text-green-700">Sign In</a>
    </p>
</x-guest-layout>

<x-guest-layout>
    {{-- Green gradient header --}}
    <div class="bg-gradient-to-br from-green-700 to-emerald-800 px-8 py-8 text-center">
        <div class="flex justify-center mb-3">
            <x-application-logo class="w-10 h-10" />
        </div>
        <h1 class="text-2xl font-bold text-white">Welcome Back</h1>
        <p class="text-green-200 text-sm mt-1">Sign in to manage your events and activities</p>
    </div>

    {{-- Form body --}}
    <div class="px-8 py-8">
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email Address')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" placeholder="you@example.com" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password"
                    name="password" placeholder="••••••••" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                    <span class="text-sm text-gray-600">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-green-600 hover:text-green-700 font-medium">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-xl transition-all duration-200 hover:-translate-y-0.5 shadow-sm hover:shadow-md">
                Sign In
            </button>
        </form>

        <div class="mt-6 pt-6 border-t border-gray-100 text-center">
            <p class="text-sm text-gray-500">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-green-600 font-semibold hover:text-green-700">
                    Create one free →
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>

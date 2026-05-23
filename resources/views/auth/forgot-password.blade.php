<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Reset Password</h1>
        <p class="text-sm text-gray-500 mt-1">Enter your email to reset your password</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                :value="old('email')" placeholder="you@example.com" required autofocus />
            <p class="text-xs text-gray-400 mt-1">We'll send you a link to reset your password</p>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-primary-button>Reset Password</x-primary-button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-5">
        Remember your password?
        <a href="{{ route('login') }}" class="text-green-600 font-semibold hover:text-green-700">Sign In</a>
    </p>
</x-guest-layout>

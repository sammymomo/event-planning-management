<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-100 min-h-screen flex flex-col justify-center items-center px-4 py-10">

        <div class="w-full max-w-md">
            <!-- Logo icon -->
            <div class="flex justify-center mb-6">
                <x-application-logo class="w-14 h-14" />
            </div>

            <!-- Card -->
            <div class="bg-white rounded-2xl shadow-md px-8 py-8">
                {{ $slot }}
            </div>

            <!-- Back to homepage -->
            <div class="text-center mt-5">
                <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-green-600 transition">
                    ← Back to Homepage
                </a>
            </div>
        </div>
    </body>
</html>

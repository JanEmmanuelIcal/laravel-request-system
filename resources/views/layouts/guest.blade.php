<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center px-4 py-10 bg-slate-950 bg-[radial-gradient(circle_at_top_right,_rgba(14,165,233,0.18),_transparent_35%),radial-gradient(circle_at_bottom_left,_rgba(99,102,241,0.16),_transparent_35%)]">
            <div class="mb-6 text-center">
                <a href="/" class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-600 text-xl font-bold text-white shadow-lg shadow-indigo-200">S</a>
                <p class="mt-3 text-lg font-semibold text-slate-900">Service Request System</p>
            </div>

            <div class="w-full sm:max-w-md rounded-2xl border border-white/10 bg-slate-900/95 px-6 py-8 shadow-2xl shadow-black/40 backdrop-blur">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Service Request System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-white">
    <div class="relative min-h-screen overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_15%,rgba(34,211,238,.18),transparent_28%),radial-gradient(circle_at_85%_20%,rgba(59,130,246,.18),transparent_28%),radial-gradient(circle_at_60%_90%,rgba(99,102,241,.16),transparent_30%)]"></div>
        <div class="absolute inset-0 opacity-[0.08] [background-image:linear-gradient(rgba(255,255,255,.2)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,.2)_1px,transparent_1px)] [background-size:48px_48px]"></div>

        <header class="relative z-10 mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-8">
            <a href="/" class="flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-cyan-400 to-blue-600 text-lg font-black shadow-lg shadow-cyan-500/20">S</span>
                <span><strong class="block text-sm font-semibold">Service Request</strong><span class="block text-xs text-slate-400">Management System</span></span>
            </a>
            <nav class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="primary-button">Open Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="hidden text-sm font-semibold text-slate-300 transition hover:text-white sm:block">Sign in</a>
                    <a href="{{ route('register') }}" class="primary-button">Create Account</a>
                @endauth
            </nav>
        </header>

        <main class="relative z-10 mx-auto grid min-h-[calc(100vh-104px)] max-w-7xl items-center gap-14 px-6 pb-16 pt-8 lg:grid-cols-[1.1fr_.9fr] lg:px-8">
            <section>
                <div class="inline-flex items-center gap-2 rounded-full border border-cyan-400/20 bg-cyan-400/10 px-4 py-2 text-sm font-medium text-cyan-300">
                    <span class="h-2 w-2 rounded-full bg-cyan-400"></span>
                    Modern request management
                </div>
                <h1 class="mt-7 max-w-3xl text-5xl font-black leading-[1.08] tracking-tight sm:text-6xl">
                    Request. Review.<br><span class="bg-gradient-to-r from-cyan-300 via-blue-400 to-indigo-400 bg-clip-text text-transparent">Keep moving.</span>
                </h1>
                <p class="mt-6 max-w-xl text-lg leading-8 text-slate-300">A streamlined workspace for submitting service requests, reviewing submissions, and keeping every status visible in real time.</p>
                <div class="mt-9 flex flex-wrap gap-4">
                    @auth
                        <a href="{{ route('requests.index') }}" class="primary-button">Go to Requests</a>
                    @else
                        <a href="{{ route('login') }}" class="primary-button">Sign in to the System</a>
                        <a href="{{ route('register') }}" class="secondary-button">Register as Requester</a>
                    @endauth
                </div>

                <div class="mt-12 grid max-w-xl grid-cols-3 gap-4 border-t border-white/10 pt-6">
                    <div><p class="text-2xl font-bold text-white">2</p><p class="mt-1 text-xs text-slate-400">Role Types</p></div>
                    <div><p class="text-2xl font-bold text-white">Live</p><p class="mt-1 text-xs text-slate-400">Status Updates</p></div>
                    <div><p class="text-2xl font-bold text-white">Secure</p><p class="mt-1 text-xs text-slate-400">Account Access</p></div>
                </div>
            </section>

            <section class="relative">
                <div class="absolute -inset-8 rounded-full bg-blue-500/10 blur-3xl"></div>
                <div class="relative overflow-hidden rounded-3xl border border-white/10 bg-slate-900/70 p-5 shadow-2xl shadow-black/40 backdrop-blur-xl">
                    <div class="flex items-center justify-between border-b border-white/10 pb-4">
                        <div><p class="text-xs font-medium uppercase tracking-widest text-slate-500">Overview</p><p class="mt-1 font-semibold">Request Activity</p></div>
                        <div class="flex gap-1.5"><span class="h-2.5 w-2.5 rounded-full bg-red-400"></span><span class="h-2.5 w-2.5 rounded-full bg-amber-400"></span><span class="h-2.5 w-2.5 rounded-full bg-green-400"></span></div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 py-5">
                        <div class="rounded-2xl border border-cyan-400/10 bg-cyan-400/10 p-4"><p class="text-xs text-cyan-300">Pending</p><p class="mt-2 text-3xl font-bold">Review</p></div>
                        <div class="rounded-2xl border border-blue-400/10 bg-blue-400/10 p-4"><p class="text-xs text-blue-300">Approved</p><p class="mt-2 text-3xl font-bold">Track</p></div>
                    </div>
                    <div class="space-y-3">
                        @foreach ([['Printer Ink','Pending','bg-amber-400'],['Notebook','Approved','bg-green-400'],['Ballpen','Pending','bg-amber-400']] as $item)
                            <div class="flex items-center justify-between rounded-xl border border-white/5 bg-white/[0.03] px-4 py-3"><div class="flex items-center gap-3"><span class="h-9 w-9 rounded-lg bg-gradient-to-br from-slate-700 to-slate-800"></span><div><p class="text-sm font-semibold">{{ $item[0] }}</p><p class="text-xs text-slate-500">Service request</p></div></div><span class="flex items-center gap-2 text-xs text-slate-300"><span class="h-2 w-2 rounded-full {{ $item[2] }}"></span>{{ $item[1] }}</span></div>
                        @endforeach
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>

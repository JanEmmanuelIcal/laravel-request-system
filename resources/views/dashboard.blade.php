<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">{{ __('Dashboard') }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl border border-cyan-400/15 bg-gradient-to-br from-slate-900 via-slate-900 to-blue-950 p-6 shadow-2xl shadow-black/20 sm:p-8">
                <div class="absolute right-0 top-0 h-40 w-40 rounded-full bg-cyan-400/10 blur-3xl"></div>
                <div class="relative">
                    <p class="text-2xl font-bold text-white">Welcome, {{ auth()->user()->name }}</p>
                    <p class="mt-2 text-sm text-slate-400">{{ auth()->user()->is_admin ? 'Manage and review all service requests.' : 'Create and track your service requests.' }}</p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('requests.index') }}" class="primary-button">{{ auth()->user()->is_admin ? 'Review Requests' : 'View My Requests' }}</a>
                        @if (!auth()->user()->is_admin)<a href="{{ route('requests.index') }}#create-request" class="secondary-button">Create Request</a>@endif
                        <a href="{{ route('profile.edit') }}" class="secondary-button">Edit Profile</a>
                    </div>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="surface-card p-5"><div class="flex items-center justify-between"><p class="text-sm text-slate-400">Total</p><span class="h-2 w-2 rounded-full bg-blue-400"></span></div><p class="mt-3 text-3xl font-bold text-white">{{ $counts['total'] }}</p></div>
                <div class="surface-card p-5"><div class="flex items-center justify-between"><p class="text-sm text-slate-400">Pending</p><span class="h-2 w-2 rounded-full bg-amber-400"></span></div><p class="mt-3 text-3xl font-bold text-amber-400">{{ $counts['pending'] }}</p></div>
                <div class="surface-card p-5"><div class="flex items-center justify-between"><p class="text-sm text-slate-400">Approved</p><span class="h-2 w-2 rounded-full bg-green-400"></span></div><p class="mt-3 text-3xl font-bold text-green-400">{{ $counts['approved'] }}</p></div>
                <div class="surface-card p-5"><div class="flex items-center justify-between"><p class="text-sm text-slate-400">Rejected</p><span class="h-2 w-2 rounded-full bg-red-400"></span></div><p class="mt-3 text-3xl font-bold text-red-400">{{ $counts['rejected'] }}</p></div>
            </div>

            <div class="surface-card mt-6 overflow-hidden">
                <div class="border-b border-white/10 px-6 py-5"><h3 class="text-lg font-semibold text-white">Recent Requests</h3></div>
                @if ($recentRequests->isEmpty())
                    <p class="px-6 py-10 text-center text-sm text-slate-500">No requests yet.</p>
                @else
                    <div class="divide-y divide-white/5">
                        @foreach ($recentRequests as $request)
                            <a href="{{ route('requests.show', $request) }}" class="flex items-center justify-between gap-4 px-6 py-4 transition hover:bg-white/5">
                                <div><p class="font-semibold text-white">{{ $request->item_name }}</p>@if(auth()->user()->is_admin)<p class="mt-1 text-sm text-slate-400">{{ $request->requester_name }}</p>@endif</div>
                                <span class="shrink-0 rounded-full px-3 py-1 text-xs font-semibold {{ $request->status === 'approved' ? 'bg-green-400/15 text-green-300' : ($request->status === 'rejected' ? 'bg-red-400/15 text-red-300' : 'bg-amber-400/15 text-amber-300') }}">{{ ucfirst($request->status) }}</span>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

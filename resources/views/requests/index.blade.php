<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-400">Request Management</p>
                <h2 class="text-xl font-semibold text-white">{{ auth()->user()->is_admin ? 'All Service Requests' : 'My Service Requests' }}</h2>
            </div>
            <a href="{{ route('dashboard') }}" class="secondary-button">Dashboard</a>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">{{ session('success') }}</div>
        @endif

        @if (!auth()->user()->is_admin)
            <section id="create-request" class="surface-card mb-8 p-6 sm:p-8">
                <h3 class="text-lg font-semibold text-white">Create a New Request</h3>
                <p class="mt-1 text-sm text-slate-400">Provide the item details and purpose for review.</p>
                <form method="POST" action="{{ route('requests.store') }}" class="mt-6 grid gap-5 md:grid-cols-2">
                    @csrf
                    <div>
                        <label for="item_name" class="mb-2 block text-sm font-medium text-slate-300">Item Name</label>
                        <input id="item_name" name="item_name" type="text" value="{{ old('item_name') }}" maxlength="150" required class="form-input">
                        @error('item_name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="quantity" class="mb-2 block text-sm font-medium text-slate-300">Quantity</label>
                        <input id="quantity" name="quantity" type="number" value="{{ old('quantity', 1) }}" min="1" required class="form-input">
                        @error('quantity')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="purpose" class="mb-2 block text-sm font-medium text-slate-300">Purpose</label>
                        <textarea id="purpose" name="purpose" maxlength="2000" rows="4" required class="form-input">{{ old('purpose') }}</textarea>
                        @error('purpose')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2"><button type="submit" class="primary-button">Submit Request</button></div>
                </form>
            </section>
        @endif

        <section class="surface-card overflow-hidden">
            <div class="border-b border-slate-200 px-6 py-5"><h3 class="text-lg font-semibold text-white">{{ auth()->user()->is_admin ? 'Request Queue' : 'Request History' }}</h3></div>
            @if ($requests->isEmpty())
                <div class="px-6 py-12 text-center"><p class="font-medium text-white">No requests found</p><p class="mt-1 text-sm text-slate-400">New requests will appear here.</p></div>
            @else
                <div class="divide-y divide-slate-100">
                    @foreach ($requests as $request)
                        <a href="{{ route('requests.show', $request) }}" class="block px-6 py-5 transition hover:bg-slate-950">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h4 class="font-semibold text-white">{{ $request->item_name }}</h4>
                                    <p class="mt-1 text-sm text-slate-400">Quantity: {{ $request->quantity }}</p>
                                    @if (auth()->user()->is_admin)<p class="mt-1 text-sm text-slate-400">Requested by {{ $request->requester_name }} Â· {{ $request->requester_email }}</p>@endif
                                </div>
                                <span class="shrink-0 rounded-full px-3 py-1 text-xs font-semibold {{ $request->status === 'approved' ? 'bg-green-100 text-green-700' : ($request->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">{{ ucfirst($request->status) }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
</x-app-layout>

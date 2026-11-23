<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div><p class="text-sm text-slate-400">Request Details</p><h2 class="text-xl font-semibold text-white">{{ $serviceRequest->item_name }}</h2></div>
            <a href="{{ route('requests.index') }}" class="secondary-button">Back to Requests</a>
        </div>
    </x-slot>

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        @if (session('success'))<div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">{{ session('success') }}</div>@endif
        <div class="surface-card overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">
                <h3 class="text-lg font-semibold text-white">Request Information</h3>
                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $serviceRequest->status === 'approved' ? 'bg-green-100 text-green-700' : ($serviceRequest->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">{{ ucfirst($serviceRequest->status) }}</span>
            </div>
            <dl class="grid gap-6 px-6 py-6 sm:grid-cols-2">
                <div><dt class="text-sm font-medium text-slate-400">Item</dt><dd class="mt-1 font-semibold text-white">{{ $serviceRequest->item_name }}</dd></div>
                <div><dt class="text-sm font-medium text-slate-400">Quantity</dt><dd class="mt-1 font-semibold text-white">{{ $serviceRequest->quantity }}</dd></div>
                <div><dt class="text-sm font-medium text-slate-400">Requester</dt><dd class="mt-1 font-semibold text-white">{{ $serviceRequest->requester_name }}</dd></div>
                <div><dt class="text-sm font-medium text-slate-400">Email</dt><dd class="mt-1 font-semibold text-white">{{ $serviceRequest->requester_email }}</dd></div>
                <div class="sm:col-span-2"><dt class="text-sm font-medium text-slate-400">Purpose</dt><dd class="mt-2 whitespace-pre-line rounded-xl bg-slate-950 p-4 text-slate-300">{{ $serviceRequest->purpose }}</dd></div>
            </dl>
            @if (auth()->user()->is_admin)
                <div class="border-t border-slate-200 px-6 py-6">
                    <h3 class="font-semibold text-white">Update Request Status</h3>
                    <form method="POST" action="{{ route('requests.updateStatus', $serviceRequest) }}" class="mt-4 flex flex-col gap-3 sm:flex-row">
                        @csrf @method('PATCH')
                        <label for="status" class="sr-only">Status</label>
                        <select name="status" id="status" class="form-input sm:max-w-xs">
                            <option value="pending" @selected($serviceRequest->status === 'pending')>Pending</option>
                            <option value="approved" @selected($serviceRequest->status === 'approved')>Approved</option>
                            <option value="rejected" @selected($serviceRequest->status === 'rejected')>Rejected</option>
                        </select>
                        <button type="submit" class="primary-button">Update Status</button>
                    </form>
                    @error('status')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

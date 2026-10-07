<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Requests</title>
</head>
<body>

    <h1>Service Requests</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <p>
        Logged in as: {{ auth()->user()->name }}
    </p>

    @if (!auth()->user()->is_admin)
        <h2>Create Request</h2>

        <form method="POST" action="{{ route('requests.store') }}">
            @csrf

            <div>
                <label for="item_name">Item Name</label>
                <input
                    type="text"
                    id="item_name"
                    name="item_name"
                    value="{{ old('item_name') }}"
                    required
                    maxlength="150"
                >
                @error('item_name')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="quantity">Quantity</label>
                <input
                    type="number"
                    id="quantity"
                    name="quantity"
                    value="{{ old('quantity') }}"
                    min="1"
                    required
                >
                @error('quantity')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="purpose">Purpose</label>
                <textarea
                    id="purpose"
                    name="purpose"
                    maxlength="2000"
                    required
                >{{ old('purpose') }}</textarea>
                @error('purpose')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">Submit Request</button>
        </form>
    @endif

    <h2>
        {{ auth()->user()->is_admin ? 'All Requests' : 'My Requests' }}
    </h2>

    @if ($requests->isEmpty())
        <p>No requests found.</p>
    @else
        @foreach ($requests as $request)
            <div>
                <h3>{{ $request->item_name }}</h3>

                <p>Quantity: {{ $request->quantity }}</p>
                <p>Purpose: {{ $request->purpose }}</p>
                <p>Status: {{ $request->status }}</p>

                @if (auth()->user()->is_admin)
                    <p>Requester: {{ $request->requester_name }}</p>
                @endif

                <a href="{{ route('requests.show', $request) }}">
                    View Request
                </a>
            </div>

            <hr>
        @endforeach
    @endif

</body>
</html>
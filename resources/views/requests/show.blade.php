<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Details</title>
</head>
<body>

    <h1>Request Details</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <p>
        <strong>Item:</strong>
        {{ $serviceRequest->item_name }}
    </p>

    <p>
        <strong>Quantity:</strong>
        {{ $serviceRequest->quantity }}
    </p>

    <p>
        <strong>Purpose:</strong>
        {{ $serviceRequest->purpose }}
    </p>

    <p>
        <strong>Requester:</strong>
        {{ $serviceRequest->requester_name }}
    </p>

    <p>
        <strong>Email:</strong>
        {{ $serviceRequest->requester_email }}
    </p>

    <p>
        <strong>Status:</strong>
        {{ $serviceRequest->status }}
    </p>

    @if (auth()->user()->is_admin)
        <h2>Update Status</h2>

        <form
            method="POST"
            action="{{ route('requests.updateStatus', $serviceRequest) }}"
        >
            @csrf
            @method('PATCH')

            <label for="status">Status</label>

            <select name="status" id="status">
                <option value="pending" @selected($serviceRequest->status === 'pending')>
                    Pending
                </option>

                <option value="approved" @selected($serviceRequest->status === 'approved')>
                    Approved
                </option>

                <option value="rejected" @selected($serviceRequest->status === 'rejected')>
                    Rejected
                </option>
            </select>

            <button type="submit">Update Status</button>
        </form>
    @endif

    <p>
        <a href="{{ route('requests.index') }}">
            Back to Requests
        </a>
    </p>

</body>
</html>
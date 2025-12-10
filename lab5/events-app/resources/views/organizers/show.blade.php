@extends('layout')

@section('content')
    <h1>Organizer Details: {{ $organizer->full_name }}</h1>

    <a href="{{ route('organizers.edit', $organizer->id) }}">
        <button style="margin-bottom: 15px;">Edit Organizer</button>
    </a>

    {{-- Basic Information --}}
    <h2>Basic Information</h2>
    <table border="1" style="width: 50%;">
        <tr>
            <th>ID</th>
            <td>{{ $organizer->id }}</td>
        </tr>
        <tr>
            <th>Full Name</th>
            <td>{{ $organizer->full_name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $organizer->email }}</td>
        </tr>
        <tr>
            <th>Phone Number</th>
            <td>{{ $organizer->phone }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $organizer->created_at->format('Y-m-d H:i') }}</td>
        </tr>
    </table>

    <br>

    {{-- List of Events (Updated to use Model fields: name, type) --}}
    <h2>Events Organized ({{ $organizer->events->count() }})</h2>

    @if ($organizer->events->count() > 0)
        <table border="1" style="width: 100%;">
            <thead>
            <tr>
                <th>ID</th>
                <th>Event Name</th>
                <th>Event Type</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($organizer->events as $event)
                <tr>
                    <td>{{ $event->id }}</td>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->type }}</td>
                    <td>{{ $event->date }}</td>
                    <td>
                        <a href="{{ route('events.show', $event->id) }}">View Event</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>This organizer has not created any events yet.</p>
    @endif

    <br>

    <a href="{{ route('organizers.index') }}">Back to Organizers</a>
@endsection

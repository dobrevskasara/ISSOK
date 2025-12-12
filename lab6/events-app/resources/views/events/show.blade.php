@extends('layout')

@section('content')
    <h1>Event Details</h1>

    <table border="1">
        <tr>
            <th>Name</th>
            <td>{{ $event->name }}</td>
        </tr>

        <tr>
            <th>Date</th>
            <td>{{ $event->date }}</td>
        </tr>

        <tr>
            <th>Type</th>
            <td>{{ ucfirst($event->type) }}</td>
        </tr>

        <tr>
            <th>Description</th>
            <td>{{ $event->description }}</td>
        </tr>

        <tr>
            <th>Organizer</th>
            <td>{{ $event->organizer->full_name ?? 'No organizer' }}</td>
        </tr>
    </table>

    <br>

    <a href="{{ route('events.index') }}">Back to Events</a>
@endsection

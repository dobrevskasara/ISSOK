@extends('layout')

@section('content')
    <h1>Events</h1>

    <form method="GET" action="{{ route('events.index') }}">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name...">
        <button type="submit">Search</button>
    </form>

    <a href="{{ route('events.create') }}">
        <button>Create Event</button>
    </a>

    <table border="1" style="margin-top:20px;">
        <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Type</th>
            <th>Description</th>
            <th>Organizer</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($events as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>{{ $event->date }}</td>
                <td>{{ ucfirst($event->type) }}</td>
                <td>{{ $event->description }}</td>
                <td>{{ $event->organizer->full_name ?? '---' }}</td>

                <td>
                    <a href="{{ route('events.show', $event->id) }}">View</a>
                    <a href="{{ route('events.edit', $event->id) }}">Edit</a>

                    <form action="{{ route('events.destroy', $event->id) }}"
                          method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this event?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $events->links() }}
    </div>
@endsection

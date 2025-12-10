@extends('layout')

@section('content')
    <h1>Edit Organizer: {{ $organizer->full_name }}</h1>

    <form action="{{ route('organizers.update', $organizer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="full_name">Full Name</label>
            <input
                type="text"
                id="full_name"
                name="full_name"
                value="{{ old('full_name', $organizer->full_name) }}"
            >
            @error('full_name') <div style="color:red;">{{ $message }}</div> @enderror
        </div>
        <div>
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $organizer->email) }}"
            >
            @error('email') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="phone">Phone Number</label>
            <input
                type="text"
                id="phone"
                name="phone"
                value="{{ old('phone', $organizer->phone) }}"
            >
            @error('phone') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <button type="submit">Update Organizer</button>
    </form>

    <a href="{{ route('organizers.index') }}">Back to Organizers</a>
@endsection

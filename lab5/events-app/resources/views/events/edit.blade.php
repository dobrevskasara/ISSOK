@extends('layout')

@section('content')
    <h1>Edit Event</h1>

    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Event Name --}}
        <div>
            <label for="name">Event Name</label>
            <input type="text" id="name" name="name"
                   value="{{ old('name', $event->name) }}">
            @error('name') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        {{-- Date --}}
        <div>
            <label for="date">Date</label>
            <input type="date" id="date" name="date"
                   value="{{ old('date', $event->date) }}">
            @error('date') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        {{-- Description --}}
        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description', $event->description) }}</textarea>
            @error('description') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        {{-- Type --}}
        <div>
            <label for="type">Type</label>
            <select name="type" id="type">
                <option value="seminar" {{ old('type', $event->type) == 'seminar' ? 'selected' : '' }}>Seminar</option>
                <option value="workshop" {{ old('type', $event->type) == 'workshop' ? 'selected' : '' }}>Workshop</option>
                <option value="lecture" {{ old('type', $event->type) == 'lecture' ? 'selected' : '' }}>Lecture</option>
            </select>
            @error('type') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        {{-- Organizer --}}
        <div>
            <label for="organizer_id">Organizer</label>
            <select name="organizer_id" id="organizer_id">
                @foreach($organizers as $organizer)
                    <option value="{{ $organizer->id }}"
                        {{ old('organizer_id', $event->organizer_id) == $organizer->id ? 'selected' : '' }}>
                        {{ $organizer->full_name }}
                    </option>
                @endforeach
            </select>
            @error('organizer_id') <div style="color:red;">{{ $message }}</div> @enderror
        </div>

        <br>
        <button type="submit">Update Event</button>
    </form>

    <br>
    <a href="{{ route('events.index') }}">Back to Events</a>
@endsection

<h1>Create New Event</h1>

<form action="{{ route('events.store') }}" method="POST">
    @csrf

    <div>
        <label for="name">Event Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}">
        @error('name') <div style="color:red;">{{ $message }}</div> @enderror
    </div>

    <div>
        <label for="date">Date</label>
        <input type="date" id="date" name="date" value="{{ old('date') }}">
        @error('date') <div style="color:red;">{{ $message }}</div> @enderror
    </div>

    <div>
        <label for="description">Description</label>
        <textarea id="description" name="description">{{ old('description') }}</textarea>
        @error('description') <div style="color:red;">{{ $message }}</div> @enderror
    </div>

    <div>
        <label for="type">Type</label>
        <select name="type" id="type">
            <option value="seminar">Seminar</option>
            <option value="workshop">Workshop</option>
            <option value="lecture">Lecture</option>
        </select>
        @error('type') <div style="color:red;">{{ $message }}</div> @enderror
    </div>

    <div>
        <label for="organizer_id">Organizer</label>
        <select name="organizer_id" id="organizer_id">
            @foreach($organizers as $organizer)
                <option value="{{ $organizer->id }}">{{ $organizer->full_name }}</option>
            @endforeach
        </select>
        @error('organizer_id') <div style="color:red;">{{ $message }}</div> @enderror
    </div>

    <button type="submit">Create Event</button>
</form>

<a href="{{ route('events.index') }}">Back</a>

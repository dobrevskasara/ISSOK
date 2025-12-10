<h1>Edit Book</h1>

<form action="{{ route('books.update', $book->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" value="{{ $book->title }}" required><br><br>

    <label for="author">Author:</label><br>
    <input type="text" id="author" name="author" value="{{ $book->author }}" required><br><br>

    <label for="published_year">Published Year:</label><br>
    <input type="number" id="published_year" name="published_year" value="{{ $book->published_year }}" required><br><br>

    <label for="isbn">ISBN:</label><br>
    <input type="text" id="isbn" name="isbn" value="{{ $book->isbn }}" required><br><br>

    <label for="genre">Genre:</label><br>
    <input type="text" id="genre" name="genre" value="{{ $book->genre }}" required><br><br>

    <label for="borrowed_by">Borrowed By (optional):</label><br>
    <input type="text" id="borrowed_by" name="borrowed_by" value="{{ $book->borrowed_by }}"><br><br>

    <label for="borrowed_date">Borrowed Date (optional):</label><br>
    <input type="date" id="borrowed_date" name="borrowed_date" value="{{ $book->borrowed_date }}"><br><br>

    <label for="return_date">Return Date (optional):</label><br>
    <input type="date" id="return_date" name="return_date" value="{{ $book->return_date }}"><br><br>

    <button type="submit">Update Book</button>
</form>

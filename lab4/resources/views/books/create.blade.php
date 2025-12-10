<h1>Create Book</h1>

<form action="{{ route('books.store') }}" method="POST">
    @csrf

    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" required><br><br>

    <label for="author">Author:</label><br>
    <input type="text" id="author" name="author" required><br><br>

    <label for="published_year">Published Year:</label><br>
    <input type="number" id="published_year" name="published_year" required><br><br>

    <label for="isbn">ISBN:</label><br>
    <input type="text" id="isbn" name="isbn" required><br><br>

    <label for="genre">Genre:</label><br>
    <input type="text" id="genre" name="genre" required><br><br>

    <label for="borrowed_by">Borrowed By (optional):</label><br>
    <input type="text" id="borrowed_by" name="borrowed_by"><br><br>

    <label for="borrowed_date">Borrowed Date (optional):</label><br>
    <input type="date" id="borrowed_date" name="borrowed_date"><br><br>

    <label for="return_date">Return Date (optional):</label><br>
    <input type="date" id="return_date" name="return_date"><br><br>

    <button type="submit">Create Book</button>
</form>

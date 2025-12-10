<div>
    <h1>Books</h1>
    <a href="{{ route('books.create') }}">Add Book</a>

    @if($books->isEmpty())
        <p>No books found.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Published Year</th>
                <th>ISBN</th>
                <th>Genre</th>
                <th>Borrowed By</th>
                <th>Borrowed Date</th>
                <th>Return Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->published_year }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->genre }}</td>
                    <td>{{ $book->borrowed_by }}</td>
                    <td>{{ $book->borrowed_date }}</td>
                    <td>{{ $book->return_date }}</td>
                    <td>
                        <a href="{{ route('books.edit', $book->id) }}">Update</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this book?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p>Total books: {{ $sum }}</p>
        <p>Total published books: {{ $borrowedCount }}</p>
    @endif
</div>

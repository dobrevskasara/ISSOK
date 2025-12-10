<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Book;

use Illuminate\Support\Facades\Redirect;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();

//        $sum = Book::all()->count();
        $sum = Book::count();
       $borrowedCount = Book::whereNotNull('borrowed_by')->count();

        return view('books/index', compact('books', 'sum', 'borrowedCount'));
    }

    public function create()
    {
        return view('books/create');
    }

    public function store(Request $request):RedirectResponse
    {
        Book::query()->create($request->all());

        return redirect()->route('books.index');
    }


    public function edit(Book $book)
    {
        return view('books/edit', compact('book'));

    }

    public function update(Request $request, Book $book):RedirectResponse
    {
        $book->update($request->all());

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book):RedirectResponse
    {
        $book->delete();

        return redirect()->route('books.index');
    }
}

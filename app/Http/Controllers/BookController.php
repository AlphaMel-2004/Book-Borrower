<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $books = Book::whereNull('deleted_at') // Ensure only non-deleted books are shown
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('author', 'like', "%{$search}%")
                        ->orWhere('isbn', 'like', "%{$search}%");
                }
            })
            ->paginate(10);

        return view('index', compact('books'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:books,isbn',
            'copies_available' => 'required|integer|min:1',
        ]);

        // Create new book
        Book::create($validatedData);

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    public function show(Book $book)
    {
        return view('show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        // Validate input data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:books,isbn,' . $book->id,
            'copies_available' => 'required|integer|min:1',
        ]);

        // Update book
        $book->update($validatedData);

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    public function destroy(Book $book)
    {
        $book->delete(); // Soft delete instead of force delete
        return redirect()->route('books.index')->with('success', 'Book moved to trash.');
    }



}

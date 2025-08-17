<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\BookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index()
    {
        $user = Auth::user();
        $books = Book::all();
        
        // Get user's current borrowings and requests
        $userBorrowings = $user->borrowings()->where('status', 'borrowed')->pluck('book_id')->toArray();
        $userRequests = $user->requests()->where('status', 'pending')->pluck('book_id')->toArray();
        
        return view('user.books.index', compact('books', 'userBorrowings', 'userRequests'));
    }

    /**
     * Borrow a book.
     */
    public function borrow(Book $book)
    {
        $user = Auth::user();
        
        // Check if user already has this book borrowed
        $existingBorrowing = Borrowing::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->where('status', 'borrowed')
            ->first();
            
        if ($existingBorrowing) {
            return redirect()->back()->with('error', 'You have already borrowed this book.');
        }
        
        // Check if book has available copies
        if ($book->getAvailableCopies() <= 0) {
            return redirect()->back()->with('error', 'No copies available for borrowing.');
        }
        
        // Create borrowing record
        $borrowing = Borrowing::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrowed_at' => now(),
            'due_at' => now()->addDays(14), // 14 days loan period
            'status' => 'borrowed'
        ]);
        
        return redirect()->back()->with('success', "Successfully borrowed '{$book->title}'. Due date: " . $borrowing->due_at->format('M d, Y'));
    }

    /**
     * Reserve a book.
     */
    public function reserve(Book $book)
    {
        $user = Auth::user();
        
        // Check if user already has a pending request for this book
        $existingRequest = BookRequest::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->where('status', 'pending')
            ->first();
            
        if ($existingRequest) {
            return redirect()->back()->with('error', 'You already have a pending request for this book.');
        }
        
        // Create book request
        BookRequest::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'type' => 'reservation',
            'status' => 'pending',
            'requested_at' => now()
        ]);
        
        return redirect()->back()->with('success', "Successfully requested to reserve '{$book->title}'. Your request is pending approval.");
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Fine;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $borrowedBooks = Borrowing::where('status', 'borrowed')->get();
        $usersWithFines = User::whereHas('fines', function($query) {
            $query->where('status', 'unpaid');
        })->get();

        return view('admin.dashboard', compact('totalBooks', 'borrowedBooks', 'usersWithFines'));
    }
}

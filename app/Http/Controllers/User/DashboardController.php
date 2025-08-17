<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get user's borrowed books
        $borrowedBooks = $user->borrowings()->where('status', 'borrowed')->with('book')->get();
        
        // Get user's unpaid fines
        $unpaidFines = $user->fines()->where('status', 'unpaid')->get();
        
        // Get user's pending requests
        $pendingRequests = $user->requests()->where('status', 'pending')->with('book')->get();
        
        return view('user.dashboard', compact('user', 'borrowedBooks', 'unpaidFines', 'pendingRequests'));
    }
}

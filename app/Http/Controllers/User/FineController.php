<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FineController extends Controller
{
    /**
     * Display a listing of the user's fines.
     */
    public function index()
    {
        $user = Auth::user();
        $fines = $user->fines()->orderBy('created_at', 'desc')->get();
        
        return view('user.fines.index', compact('fines', 'user'));
    }
}

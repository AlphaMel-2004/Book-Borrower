<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return redirect()->route('books.index'); // Redirects to books list
});

// Resourceful routes for CRUD operations
Route::resource('books', BookController::class);


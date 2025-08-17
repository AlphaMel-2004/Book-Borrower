<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->is_admin 
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    }
    return redirect()->route('login');
});

// General dashboard route that redirects based on user role
Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    
    return Auth::user()->is_admin 
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');
})->middleware('auth')->name('dashboard');

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\RequestController;
use App\Http\Controllers\Admin\FineController;
use App\Http\Controllers\Admin\UserLogController;

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Users
    Route::resource('users', UserController::class);
    
    // Books
    Route::resource('books', BookController::class);
    
    // Requests
    Route::get('requests', [RequestController::class, 'index'])->name('requests.index');
    Route::post('requests/{request}/approve', [RequestController::class, 'approve'])->name('requests.approve');
    Route::post('requests/{request}/reject', [RequestController::class, 'reject'])->name('requests.reject');
    
    // Fines
    Route::get('fines', [FineController::class, 'index'])->name('fines.index');
    Route::post('fines/{fine}/mark-as-paid', [FineController::class, 'markAsPaid'])->name('fines.mark-as-paid');
    
    // User Logs
    Route::get('user-logs', [UserLogController::class, 'index'])->name('user-logs.index');
});

// Profile Routes (accessible to all authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User Routes
Route::middleware('auth')->name('user.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');

    // Books
    Route::get('/books', [App\Http\Controllers\User\BookController::class, 'index'])->name('books.index');
    Route::post('/books/{book}/borrow', [App\Http\Controllers\User\BookController::class, 'borrow'])->name('books.borrow');
    Route::post('/books/{book}/reserve', [App\Http\Controllers\User\BookController::class, 'reserve'])->name('books.reserve');
    
    // Fines
    Route::get('/fines', [App\Http\Controllers\User\FineController::class, 'index'])->name('fines.index');
});

require __DIR__.'/auth.php';

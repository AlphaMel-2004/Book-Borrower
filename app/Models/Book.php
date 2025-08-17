<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'author', 'isbn', 'copies_available'];

    protected $dates = ['deleted_at'];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function requests()
    {
        return $this->hasMany(BookRequest::class);
    }

    public function getCurrentBorrowingsCount()
    {
        return $this->borrowings()->where('status', 'borrowed')->count();
    }

    public function getAvailableCopies()
    {
        return $this->copies_available - $this->getCurrentBorrowingsCount();
    }
}

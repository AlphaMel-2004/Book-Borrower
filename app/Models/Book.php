<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'isbn', 'copies_available'];

    use SoftDeletes;

    protected $dates = ['deleted_at']; // Enables deleted_at field
}

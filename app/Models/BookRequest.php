<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'book_id',
        'type',
        'status',
        'requested_at',
        'processed_at'
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'processed_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}

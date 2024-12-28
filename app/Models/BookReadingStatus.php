<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookReadingStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'user_id',
        'reading_status',
    ];

    protected $casts = [
        'reading_status' => 'string',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

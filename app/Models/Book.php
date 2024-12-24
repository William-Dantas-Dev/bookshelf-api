<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'genre',
        'description',
        'coverImage',
        'publicationDate',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'coverImage',
        'publicationDate',
        'author_id',
        'user_id',
    ];

    protected $hidden = [
        'author_id',
        'user_id',
    ];

    protected $casts = [
        'publicationDate' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function bookReadingStatus()
    {
        return $this->belongsTo(BookReadingStatus::class);
    }

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    public function comment_replies()
    {
        return $this->belongsTo(CommentReply::class);
    }

    public function saved_by()
    {
        return $this->belongsToMany(User::class, 'saved_books')->withTimestamps();
    }
}

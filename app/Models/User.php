<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function bookReadingStatus()
    {
        return $this->hasMany(BookReadingStatus::class);
    }

    public function book(){
        return $this->hasMany(Book::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function comment_replies()
    {
        return $this->hasMany(CommentReply::class);
    }

    public function saved_books()
    {
        return $this->belongsToMany(Book::class, 'saved_books')->withTimestamps();
    }
}

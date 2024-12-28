<?php

namespace App\Repositories\V1;

use App\Contracts\Favorite\FavoriteRepositoryContract;
use App\Models\Book;
use App\Models\User;

class FavoriteRepository implements FavoriteRepositoryContract
{
    public function favoriteBook(User $user, Book $book)
    {
        if ($user->saved_books()->where('book_id', $book->id)->exists()) {
            throw new \InvalidArgumentException('The book is already in your favorites.');
        }
        return $user->saved_books()->sync($book->id);
    }

    public function unfavoriteBook(User $user, Book $book): void
    {
        if (!$user->saved_books()->where('book_id', $book->id)->exists()) {
            throw new \InvalidArgumentException('The book is not in your favorites.');
        }
        $user->saved_books()->detach($book);
    }

    public function getUserFavoritesBooks(User $user)
    {
        return $user->saved_books()->get();
    }

    public function getMyFavoritesBooks(User $user) {
        return $user->saved_books()->get();
    }
}

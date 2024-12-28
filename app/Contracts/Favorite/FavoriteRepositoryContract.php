<?php

namespace App\Contracts\Favorite;

use App\Models\Book;
use App\Models\User;

interface FavoriteRepositoryContract
{
    public function favoriteBook(User $user, Book $book);
    public function unfavoriteBook(User $user, Book $book);
    public function getUserFavoritesBooks(User $user);
    public function getMyFavoritesBooks(User $user);
}

<?php

namespace App\Contracts\Favorite;

use App\Models\User;

interface FavoriteControllerContract
{
    public function favoriteBook(string $bookId);
    public function unfavoriteBook(string $bookId);
    public function getUserFavoritesBooks(User $user);
    public function getMyFavoritesBooks();
}

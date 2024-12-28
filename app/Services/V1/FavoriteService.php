<?php

namespace App\Services\V1;

use App\Contracts\Favorite\FavoriteServiceContract;
use App\Models\Book;
use App\Models\User;
use App\Repositories\V1\FavoriteRepository;
use Illuminate\Support\Facades\Auth;

class FavoriteService implements FavoriteServiceContract
{
    protected $favoriteRepository;

    public function __construct(FavoriteRepository $favoriteRepository)
    {
        $this->favoriteRepository = $favoriteRepository;
    }

    public function favoriteBook(string $bookId): void
    {
        $user = Auth::user();
        $book = Book::find($bookId);
        if (!$book) {
            throw new \InvalidArgumentException('The specified book does not exist.');
        }
        $this->favoriteRepository->favoriteBook($user, $book);
    }

    public function unfavoriteBook(string $bookId): void
    {
        $user = Auth::user();
        $book = Book::find($bookId);
        if (!$book) {
            throw new \InvalidArgumentException('The specified book does not exist.');
        }
        $this->favoriteRepository->unfavoriteBook($user, $book);
    }

    public function getUserFavoritesBooks(User $user)
    {
        return $this->favoriteRepository->getUserFavoritesBooks($user);
    }

    public function getMyFavoritesBooks()
    {
        $user = Auth::user();
        return $this->favoriteRepository->getMyFavoritesBooks($user);
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\Favorite\FavoriteControllerContract;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\V1\FavoriteService;

class FavoriteController extends Controller implements FavoriteControllerContract
{
    protected $favoriteService;

    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    public function favoriteBook(string $bookId)
    {
        try {
            $this->favoriteService->favoriteBook($bookId);
            return response()->json(['message' => 'Book successfully favorited!'], 200);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['message' => 'Invalid request: ' . $e->getMessage()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while favoriting the book. Please try again later.'], 500);
        }
    }

    public function unfavoriteBook(string $bookId)
    {
        try {
            $this->favoriteService->unfavoriteBook($bookId);
            return response()->json(['message' => 'Book successfully unfavorited!'], 200);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An unexpected error occurred.'], 500);
        }
    }

    public function getUserFavoritesBooks(User $user)
    {
        try {
            $favorites = $this->favoriteService->getUserFavoritesBooks($user);
            return response()->json(['favorites' => $favorites], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching user favorites: ' . $e->getMessage()], 500);
        }
    }

    public function getMyFavoritesBooks()
    {
        try {
            $favorites = $this->favoriteService->getMyFavoritesBooks();
            return response()->json(['favorites' => $favorites], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching user favorites: ' . $e->getMessage()], 500);
        }
    }
}

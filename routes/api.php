<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\AuthorController;
use App\Http\Controllers\Api\V1\BookController;
use App\Http\Controllers\Api\V1\FavoriteController;
use App\Http\Controllers\Api\V1\GenreController;
use App\Http\Controllers\Api\V1\TagController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

#Route::apiResource('posts', PostController::class);

Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::apiResource('users', UserController::class);
        Route::apiResource('genres', GenreController::class);
        Route::apiResource('books', BookController::class);
        Route::apiResource('authors', AuthorController::class);
        Route::apiResource('tags', TagController::class);

        Route::post('/books/{bookId}/favorite', [FavoriteController::class, 'favoriteBook']);
        Route::delete('/books/{bookId}/unfavorite', [FavoriteController::class, 'unfavoriteBook']);
        Route::get('/users/{user}/books/favorites', [FavoriteController::class, 'getUserFavoritesBooks']);
        Route::get('/users/books/my-favorites', [FavoriteController::class, 'getMyFavoritesBooks']);


        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

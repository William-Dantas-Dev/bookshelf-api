<?php

namespace App\Repositories\V1;

use App\Contracts\Book\BookRepositoryContract;
use App\DTO\BookDTO;
use App\Models\Book;

class BookRepository implements BookRepositoryContract
{

    public function index()
    {
        return Book::all()->load('author', 'user', 'genres', 'tags', 'saved_by');
    }

    public function show(string $id)
    {
        return Book::findOrFail($id)->load('author', 'user', 'genres', 'tags', 'saved_by');
    }

    public function store(BookDTO $bookDTO)
    {
        $book = Book::create($bookDTO->toArray());
        $book->genres()->sync($bookDTO->genres_id);
        return $book->load('author', 'user', 'genres', 'tags', 'saved_by');
    }

    public function update(BookDTO $bookDTO, string $id)
    {
        $book = Book::findOrFail($id);
        $book->update($bookDTO->toArray());

        if($bookDTO->genres_id){
            $book->genres()->sync($bookDTO->genres_id);
        }
        if($bookDTO->tags_id){
            $book->tags()->sync($bookDTO->tags_id);
        }

        return $book->load('author', 'user', 'genres', 'tags', 'saved_by');
    }

    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        if (!$book) return false;
        return $book->delete();
    }
}

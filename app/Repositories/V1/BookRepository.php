<?php

namespace App\Repositories\V1;

use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Models\Book;

class BookRepository
{

    public function index()
    {
        return Book::all();
    }

    public function show(string $id)
    {
        return Book::findOrFail($id);
    }

    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());

        // Sincronizar os gêneros
        $book->genres()->sync($request->input('genres'));

        return $book->load('genres');
    }

    public function update(UpdateBookRequest $request, string $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->validated());

        if($request->has('genres')){
            $book->genres()->sync($request->input('genres'));
        }

        return $book->load('genres');
    }

    public function delete(string $id)
    {
        $book = Book::findOrFail($id);
        if (!$book) return false;
        return $book->delete();
    }
}

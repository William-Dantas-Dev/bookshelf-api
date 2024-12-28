<?php

namespace App\Repositories\V1;

use App\Contracts\Author\AuthorRepositoryContract;
use App\DTO\AuthorDTO;
use App\Models\Author;

class AuthorRepository implements AuthorRepositoryContract
{

    public function index()
    {
        return Author::all();
    }

    public function show(string $id)
    {
        return Author::findOrFail($id);
    }

    public function store(AuthorDTO $authorDTO)
    {
        return Author::create($authorDTO->toArray());
    }

    public function update(AuthorDTO $authorDTO, string $id)
    {
        $author = Author::findOrFail($id);
        $author->update($authorDTO->toArray());
        return $author;
    }

    public function destroy(string $id)
    {
        $author = Author::findOrFail($id);
        if (!$author) return false;
        return $author->delete();
    }
}

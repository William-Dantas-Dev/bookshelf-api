<?php

namespace App\Repositories\V1;

use App\Contracts\Genre\GenreRepositoryContract;
use App\DTO\GenreDTO;
use App\Models\Genre;

class GenreRepository implements GenreRepositoryContract
{

    public function index()
    {
        return Genre::all();
    }

    public function show(string $id)
    {
        return Genre::findOrFail($id);
    }

    public function store(GenreDTO $genreDTO)
    {
        return Genre::create($genreDTO->toArray());
    }

    public function update(GenreDTO $genreDTO, string $id)
    {
        $genre = Genre::findOrFail($id);
        $genre->update($genreDTO->toArray());
        return $genre;
    }

    public function destroy(string $id)
    {
        $genre = Genre::findOrFail($id);
        if (!$genre) return false;
        return $genre->delete();
    }
}

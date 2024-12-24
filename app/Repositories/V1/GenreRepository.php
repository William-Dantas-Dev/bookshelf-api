<?php

namespace App\Repositories\V1;

use App\Http\Requests\Genre\StoreGenreRequest;
use App\Http\Requests\Genre\UpdateGenreRequest;
use App\Models\Genre;

class GenreRepository
{

    public function index()
    {
        return Genre::all();
    }

    public function show(string $id)
    {
        return Genre::findOrFail($id);
    }

    public function store(StoreGenreRequest $request)
    {
        return Genre::create($request->validated());
    }

    public function update(UpdateGenreRequest $request, string $id)
    {
        $genre = Genre::findOrFail($id);
        $genre->update($request->validated());
        return $genre;
    }

    public function delete(string $id)
    {
        $genre = Genre::findOrFail($id);
        if(!$genre) return false;
        return $genre->delete();
    }
}

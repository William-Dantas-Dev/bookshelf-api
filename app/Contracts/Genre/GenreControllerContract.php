<?php

namespace App\Contracts\User;

use App\Http\Requests\Genre\StoreGenreRequest;
use App\Http\Requests\Genre\UpdateGenreRequest;

interface GenreControllerContract
{
    public function index();
    public function show(string $id);
    public function store(StoreGenreRequest $request);
    public function update(UpdateGenreRequest $request, string $id);
    public function destroy(string $id);
}

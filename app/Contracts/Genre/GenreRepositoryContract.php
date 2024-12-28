<?php

namespace App\Contracts\Genre;

use App\DTO\GenreDTO;

interface GenreRepositoryContract
{
    public function index();
    public function show(string $id);
    public function store(GenreDTO $genreDTO);
    public function update(GenreDTO $genreDTO, string $id);
    public function destroy(string $id);
}

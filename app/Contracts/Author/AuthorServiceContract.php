<?php

namespace App\Contracts\Author;

use App\DTO\AuthorDTO;

interface AuthorServiceContract
{
    public function index();
    public function show(string $id);
    public function store(AuthorDTO $authorDTO);
    public function update(AuthorDTO $authorDTO, string $id);
    public function destroy(string $id);
}

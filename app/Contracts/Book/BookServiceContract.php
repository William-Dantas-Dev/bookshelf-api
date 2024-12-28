<?php

namespace App\Contracts\Book;

use App\DTO\BookDTO;

interface BookServiceContract
{
    public function index();
    public function show(string $id);
    public function store(BookDTO $bookDTO);
    public function update(BookDTO $bookDTO, string $id);
    public function destroy(string $id);
}

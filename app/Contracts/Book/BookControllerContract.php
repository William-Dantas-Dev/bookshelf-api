<?php

namespace App\Contracts\Book;

use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;

interface BookControllerContract
{
    public function index();
    public function show(string $id);
    public function store(StoreBookRequest $request);
    public function update(UpdateBookRequest $request, string $id);
    public function destroy(string $id);
}

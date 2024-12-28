<?php

namespace App\Contracts\User;

use App\Http\Requests\Author\StoreAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;

interface AuthorControllerContract
{
    public function index();
    public function show(string $id);
    public function store(StoreAuthorRequest $request);
    public function update(UpdateAuthorRequest $request, string $id);
    public function destroy(string $id);
}

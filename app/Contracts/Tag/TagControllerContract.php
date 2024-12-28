<?php

namespace App\Contracts\User;

use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;

interface TagControllerContract
{
    public function index();
    public function show(string $id);
    public function store(StoreTagRequest $request);
    public function update(UpdateTagRequest $request, string $id);
    public function destroy(string $id);
}

<?php

namespace App\Contracts\Tag;

use App\DTO\TagDTO;

interface TagRepositoryContract
{
    public function index();
    public function show(string $id);
    public function store(TagDTO $tagDTO);
    public function update(TagDTO $tagDTO, string $id);
    public function destroy(string $id);
}

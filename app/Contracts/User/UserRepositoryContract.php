<?php

namespace App\Contracts\User;

use App\DTO\UserDTO;

interface UserRepositoryContract
{
    public function index();
    public function show(string $id);
    public function store(UserDTO $userDTO);
    public function update(UserDTO $userDTO, string $id);
    public function destroy(string $id);
}

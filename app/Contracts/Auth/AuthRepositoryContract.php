<?php

namespace App\Contracts\Author;

use App\DTO\AuthDTO;
use App\Models\User;

interface AuthRepositoryContract
{
    public function register(AuthDTO $authDTO);
    public function login(User $user);
    public function logout(User $user);
}

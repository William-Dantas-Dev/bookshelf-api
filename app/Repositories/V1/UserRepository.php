<?php

namespace App\Repositories\V1;

use App\DTO\UserDTO;
use App\Models\User;

class UserRepository
{

    public function index()
    {
        return User::all();
    }

    public function show(string $id)
    {
        return User::find($id);
    }

    public function store(UserDTO $user)
    {
        return User::create($user->toArray());
    }

    public function update(UserDTO $user, string $id)
    {
        $user = User::findOrFail($id);
        $user->update($user->toArray());
        return $user;
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) return false;

        return $user->destroy();
    }
}

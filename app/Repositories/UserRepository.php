<?php

namespace App\Repositories;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;

class UserRepository
{

    public function getAllUsers()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function store(StoreUserRequest $user)
    {
        return User::create($user->validated());
    }

    public function update($id, UpdateUserRequest $request)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());
        return $user;
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) return false;

        return $user->delete();
    }
}

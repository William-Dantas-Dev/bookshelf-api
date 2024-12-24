<?php

namespace App\Repositories\V1;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
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

    public function store(StoreUserRequest $user)
    {
        return User::create($user->validated());
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());
        return $user;
    }

    public function delete(string $id)
    {
        $user = User::find($id);
        if (!$user) return false;

        return $user->delete();
    }
}

<?php

namespace App\Repositories\V1;

use App\Http\Requests\Auth\RegisterAuthRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthRepository
{
    public function register(RegisterAuthRequest $request)
    {
        return User::create($request->validated());
    }


    public function login(User $user)
    {
        return $user->createToken($user->name);
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();

        return [
            'message' => 'You are logouted'
        ];
    }
}

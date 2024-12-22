<?php

namespace App\Services;

use App\Http\Requests\Auth\LoginAuthRequest;
use App\Http\Requests\Auth\RegisterAuthRequest;
use App\Models\User;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthService
{
    protected $AuthRepository;

    public function __construct(AuthRepository $AuthRepository)
    {
        $this->AuthRepository = $AuthRepository;
    }

    public function register(RegisterAuthRequest $request)
    {
        $user = $this->AuthRepository->register($request);
        $token = $user->createToken($request->name);
        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function login(LoginAuthRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return [
                'message' => 'Invalid credentials'
            ];
        }

        $token = $this->AuthRepository->login($user);
        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function logout(Request $request) {
        return $this->AuthRepository->logout($request);
    }
}

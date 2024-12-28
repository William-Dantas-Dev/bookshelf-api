<?php

namespace App\Contracts\User;

use App\Http\Requests\Auth\LoginAuthRequest;
use App\Http\Requests\Auth\RegisterAuthRequest;
use Illuminate\Http\Request;

interface AuthControllerContract
{
    public function register(RegisterAuthRequest $request);
    public function login(LoginAuthRequest $request);
    public function logout(Request $request);
}

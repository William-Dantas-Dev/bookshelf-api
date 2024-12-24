<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginAuthRequest;
use App\Http\Requests\Auth\RegisterAuthRequest;
use App\Services\V1\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterAuthRequest $request) {
        return $this->authService->register($request);
    }

    public function login(LoginAuthRequest $request) {
        return $this->authService->login($request);
    }

    public function logout(Request $request) {
        return $this->authService->logout($request);
    }
}

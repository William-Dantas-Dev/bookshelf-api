<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\User\AuthControllerContract;
use App\DTO\AuthDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginAuthRequest;
use App\Http\Requests\Auth\RegisterAuthRequest;
use App\Services\V1\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller implements AuthControllerContract
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterAuthRequest $request)
    {
        try {
            $user = $this->authService->register(AuthDTO::fromArray($request->all()));

            if ($user) {
                return response()->json([
                    'message' => 'Usuário registrado com sucesso.',
                    'user' => $user
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Falha ao registrar o usuário.'
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao registrar usuário.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function login(LoginAuthRequest $request)
    {
        try {
            $result = $this->authService->login(AuthDTO::fromArray($request->all()));

            if (isset($result['error'])) {
                return response()->json([
                    'message' => $result['error']
                ], 401);
            }

            return response()->json([
                'user' => $result['user'],
                'token' => $result['token']
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $result = $this->authService->logout($request->user());

            if (isset($result['error'])) {
                return response()->json([
                    'message' => $result['error']
                ], 400);
            }

            return response()->json([
                'message' => $result['message']
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

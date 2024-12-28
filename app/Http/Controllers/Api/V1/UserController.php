<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\User\UserControllerContract;
use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\V1\UserService;

class UserController extends Controller implements UserControllerContract
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        try {
            $users = $this->userService->index();

            if ($users->isEmpty()) {
                return response()->json([
                    'message' => 'No users found',
                ], 404);
            }

            return response()->json([
                'message' => 'Users retrieved successfully',
                'users' => $users,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving users',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $user = $this->userService->show($id);
            if (!$user) {
                return response()->json([
                    'message' => 'User not found',
                ], 404);
            }

            return response()->json([
                'message' => 'User retrieved successfully',
                'user' => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $user = $this->userService->store(UserDTO::fromArray($request->all()));
            return response()->json([
                'message' => 'User created successfully',
                'user' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            $user = $this->userService->update(UserDTO::fromArray($request->all()), $id);
            if (!$request) {
                return response()->json([
                    'message' => 'User not found',
                ], 404);
            }

            return response()->json([
                'message' => 'User updated successfully',
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        $deleted = $this->userService->destroy($id);

        if ($deleted) {
            return response()->json([
                'message' => 'User deleted successfully.',
            ], 200);
        }
        return response()->json([
            'message' => 'Error trying to delete user.',
        ], 400);
    }
}

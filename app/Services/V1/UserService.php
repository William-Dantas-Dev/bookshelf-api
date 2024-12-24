<?php

namespace App\Services\V1;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Repositories\V1\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        try {
            $users = $this->userRepository->index();

            if($users->isEmpty()) {
                return response()->json([
                    'message' => 'No users found',
                ], 404);
            }

            return response()->json([
                'message' => 'Users retrieved successfully',
                'users' => $users,
            ], 200);
        } catch(\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving users',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $user = $this->userRepository->show($id);
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
            $user = $this->userRepository->store($request);
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
           $user = $this->userRepository->update($request, $id);
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

    public function delete(string $id)
    {
        $deleted = $this->userRepository->delete($id);

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

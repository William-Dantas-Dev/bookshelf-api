<?php

namespace App\Services\V1;

use App\DTO\UserDTO;
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
        return $this->userRepository->index();
    }

    public function show(string $id)
    {
        return $this->userRepository->show($id);
    }

    public function store(UserDTO $userDTO)
    {
        return $this->userRepository->store($userDTO);
    }

    public function update(UserDTO $userDTO, string $id)
    {
        return $this->userRepository->update($userDTO, $id);
    }

    public function destroy(string $id)
    {
        return $this->userRepository->destroy($id);
    }
}

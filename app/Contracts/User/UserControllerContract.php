<?php

namespace App\Contracts\User;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

interface UserControllerContract
{
    public function index();
    public function show(string $id);
    public function store(StoreUserRequest $request);
    public function update(UpdateUserRequest $request, string $id);
    public function destroy(string $id);
}

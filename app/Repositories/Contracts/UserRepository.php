<?php

namespace App\Repositories\Contracts;

use App\Dto\UserDto;

interface UserRepository
{
    public function getUserByEmail(string $email): UserDto;

    public function getUserById(int $id): UserDto;
}

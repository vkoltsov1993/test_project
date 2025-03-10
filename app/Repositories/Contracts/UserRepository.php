<?php

namespace App\Repositories\Contracts;

use App\Dto\UserDto;

interface UserRepository
{
    public function getUser(): UserDto;


}

<?php

namespace App\Dto;

class UserDto extends Dto
{
    public readonly int $id;
    public readonly string $email;
    public readonly string $name;
}

<?php

namespace App\Dto;

use App\Exceptions\DtoException;

class ProductUrlDto extends Dto
{
    public readonly int $id;
    public readonly string $name;
    public readonly string $url;
    public readonly string $price;
    public readonly int $shop;
    public readonly array $users;
}

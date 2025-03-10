<?php

namespace App\Repositories\Contracts;

use App\Dto\ProductUrlDto;

interface ProductUrlRepository
{
    /**
     * @return ProductUrlDto[]
     */
    public function getWithUsersEmailActivated(): array;

    public function updateOrCreate(array $attributes, array $values = []): ProductUrlDto;
}

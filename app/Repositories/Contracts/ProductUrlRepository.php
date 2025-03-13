<?php

namespace App\Repositories\Contracts;

use App\Dto\ProductUrlDto;
use App\Dto\UserDto;

interface ProductUrlRepository
{
    /**
     * @return ProductUrlDto[]
     */
    public function getWithUsersEmailActivated(): array;

    public function updateOrCreate(array $attributes, array $values = []): ProductUrlDto;

    /**
     * @param UserDto $userDto
     * @param $productUrls []
     * @return mixed
     */
    public function syncWithUser(UserDto $userDto, array $productUrls): array;
}

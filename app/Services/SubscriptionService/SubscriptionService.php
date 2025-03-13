<?php

namespace App\Services\SubscriptionService;

use App\Dto\ProductUrlDto;
use App\Repositories\Contracts\ProductUrlRepository;
use App\Repositories\Contracts\UserRepository;

abstract class SubscriptionService
{
    public function __construct(
        protected readonly ProductUrlRepository $productUrlRepository,
        protected readonly UserRepository       $userRepository,
    )
    {
    }

    public function subscribe(string $url, string $email): ProductUrlDto
    {
        $productUrlDto = $this->getProductWithUpdatedPrice($url);
        $userDto = $this->userRepository->getUserByEmail($email);

        $this->productUrlRepository->syncWithUser($userDto, [$productUrlDto->id]);

        return $productUrlDto;
    }

    abstract public function getProductWithUpdatedPrice(string $url): ProductUrlDto;
}

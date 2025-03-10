<?php

namespace App\Services\SubscriptionService;

use App\Models\ProductUrl;
use App\Models\User;
use App\Repositories\Contracts\ProductUrlRepository;

abstract class SubscriptionService
{
    public function __construct(
        protected readonly ProductUrlRepository $productUrlRepository
    )
    {
    }

    public function subscribe(string $url, string $email): ProductUrl
    {
        $productUrl = $this->getNewProductPrice($url);

        $user = User::query()
            ->where('email', $email)
            ->firstOrFail();

        $user->productUrls()->sync($productUrl);

        return $productUrl;
    }

    abstract public function getNewProductPrice(string $url): float;
}

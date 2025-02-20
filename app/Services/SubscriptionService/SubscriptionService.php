<?php

namespace App\Services\SubscriptionService;

use App\Models\ProductUrl;
use App\Models\User;

abstract class SubscriptionService
{
    public function subscribe(string $url, string $email): ProductUrl
    {
        $productUrl = $this->getProductUrl($url);

        $user = User::query()
            ->where('email', $email)
            ->firstOrFail();

        $user->productUrls()->sync($productUrl);

        return $productUrl;
    }

    abstract public function getProductUrl(string $url): ProductUrl;
}

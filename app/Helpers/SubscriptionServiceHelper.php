<?php

namespace App\Helpers;

use App\Enums\Shop;
use App\Services\SubscriptionService\Shops\OlxSubscriptionService;

class SubscriptionServiceHelper
{
    public static function getServiceClass(Shop $shop): string
    {
        return match ($shop) {
            Shop::Olx => OlxSubscriptionService::class,
        };
    }
}

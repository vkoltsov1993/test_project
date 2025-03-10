<?php

namespace App\Services\CheckPriceService;

use App\Enums\Shop;
use App\Exceptions\CheckPriceException;
use App\Jobs\PriceChangedNotificationJob;
use App\Repositories\Contracts\ProductUrlRepository;
use App\Services\SubscriptionService\PriceChangedEmailNotifier;
use App\Services\SubscriptionService\ProductPublisher;
use App\Services\SubscriptionService\Publisher;
use App\Services\SubscriptionService\SubscriptionService;

class CheckPriceService
{
    private readonly Publisher $publisher;

    public function __construct(private readonly ProductUrlRepository $productUrlRepository)
    {
    }

    public function run(): void
    {
        $this->publisher = new ProductPublisher();

        $productUrls = $this->productUrlRepository->getWithUsersEmailActivated();

        foreach ($productUrls as $productUrl) {
            $newPrice = $this->getNewProductPrice($productUrl->url, $productUrl->shop);
            if ($newPrice !== (float)$productUrl->price) {
                $users = $productUrl->users;
                array_walk($users, function ($user) use ($productUrl, $newPrice) {
                    $subscriber = new PriceChangedEmailNotifier($user, $productUrl, $newPrice);
                    $this->publisher->attach($subscriber);
                });
            }
        }

        if ($this->publisher->getSubscriptionCount()) {
            PriceChangedNotificationJob::dispatch($this->publisher);
        }
    }

    private function getNewProductPrice(string $url, int $shopId): float
    {
        $subscriptionService = $this->setSubscriptionService($shopId);

        return $subscriptionService->getNewProductPrice($url);
    }

    private function setSubscriptionService(int $shopId): SubscriptionService
    {
        $shop = Shop::from($shopId);
        $subscriptionServiceClassName = "App\\Services\\SubscriptionService\\Shops\\{$shop->name}SubscriptionService";
        if (! class_exists($subscriptionServiceClassName)) {
            $error = "Can not find '{$subscriptionServiceClassName}' class";
            throw new CheckPriceException($error);
        }

        return app($subscriptionServiceClassName);
    }
}

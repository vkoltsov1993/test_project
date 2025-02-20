<?php

namespace App\Services\CheckPriceService;

use App\Exceptions\CheckPriceException;
use App\Jobs\PriceChangedNotificationJob;
use App\Models\ProductUrl;
use App\Models\User;
use App\Services\SubscriptionService\EmailNotifier;
use App\Services\SubscriptionService\PriceChangedEmailNotifier;
use App\Services\SubscriptionService\ProductPublisher;
use App\Services\SubscriptionService\Publisher;
use App\Services\SubscriptionService\ProductSubscriber;
use Illuminate\Database\Eloquent\Builder;

class CheckPriceService
{
    private readonly Publisher $publisher;

    public function run(): void
    {
        $this->publisher = new ProductPublisher();

        $productUrls = ProductUrl::query()
            ->whereHas('users', function (Builder $query) {
                $query->whereNotNull('email_verified_at');
            })
            ->get();

        foreach ($productUrls as $productUrl) {
            $newPrice = $this->getNewProductPrice($productUrl);
            if ($newPrice !== (float)$productUrl->price) {
                $productUrl->users()->each(function (User $user) use ($productUrl, $newPrice) {
                    $subscriber = new PriceChangedEmailNotifier($user, $productUrl, $newPrice);
                    $this->publisher->attach($subscriber);
                });
            }
        }

        if ($this->publisher->getSubscriptionCount()) {
            PriceChangedNotificationJob::dispatch($this->publisher);
        }
    }

    private function getNewProductPrice(ProductUrl $productUrl): float
    {
        $subscriptionServiceClassName = "App\\Services\\SubscriptionService\\{$productUrl->shop->name}SubscriptionService";
        if (! class_exists($subscriptionServiceClassName)) {
            $error = "Can not find '{$subscriptionServiceClassName}' class";
            throw new CheckPriceException($error);
        }
        $subscriptionServiceClass = new $subscriptionServiceClassName();

        $updatedProductUrl = $subscriptionServiceClass->getProductUrl($productUrl->url);

        return $updatedProductUrl->price;
    }
}

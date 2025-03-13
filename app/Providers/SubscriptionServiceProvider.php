<?php

namespace App\Providers;

use App\Enums\Shop;
use App\Exceptions\ShopDoesNotFoundException;
use App\Helpers\SubscriptionServiceHelper;
use App\Services\SubscriptionService\SubscriptionService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class SubscriptionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        if (request()->path() === 'api/product' && request()->has('shop')) {
            $this->app->singleton(SubscriptionService::class, function (Application $application) {
                $shopId = (int)request('shop');
                $shop = Shop::tryFrom($shopId);
                if (! $shop) {
                    throw new ShopDoesNotFoundException($shopId);
                }
                $serviceClass = SubscriptionServiceHelper::getServiceClass($shop);
                return app($serviceClass);
            });
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}

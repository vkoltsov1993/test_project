<?php

namespace App\Providers;

use App\Repositories\Contracts\ProductUrlRepository;
use App\Repositories\Repositories\ProductUrlEloquentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ProductUrlRepository::class, ProductUrlEloquentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

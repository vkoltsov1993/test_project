<?php

namespace App\Providers;

use App\Repositories\Contracts\ProductUrlRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Repositories\ProductUrlEloquentRepository;
use App\Repositories\Repositories\UserEloquentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public $singletons = [
        ProductUrlRepository::class => ProductUrlEloquentRepository::class,
        UserRepository::class => UserEloquentRepository::class,
    ];

    public function register(): void
    {

    }

    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Repositories\Repositories;

use App\Dto\ProductUrlDto;
use App\Dto\UserDto;
use App\Models\ProductUrl;
use App\Models\User;
use App\Repositories\Contracts\ProductUrlRepository;
use Illuminate\Database\Eloquent\Builder;

class ProductUrlEloquentRepository implements ProductUrlRepository
{
    /**
     * @return ProductUrlDto[]
     */
    public function getWithUsersEmailActivated(): array
    {
        $productUrlDtoArray = [];

        ProductUrl::query()
            ->whereHas('users', function (Builder $query) {
                $query->whereNotNull('email_verified_at');
            })
            ->with('users')
            ->each(function (ProductUrl $productUrl) use (&$productUrlDtoArray) {
                $productUrlData = $productUrl->toArray();
                $userDtoArray = [];
                $productUrl
                    ->users()
                    ->each(function (User $user) use (&$userDtoArray) {
                        $userDtoArray[] = new UserDto($user->toArray());
                    });
                $productUrlData['users'] = $userDtoArray;

                $productUrlDtoArray[] = new ProductUrlDto($productUrlData);
            });

        return $productUrlDtoArray;
    }

    public function updateOrCreate(array $attributes, array $values = []): ProductUrlDto
    {
        $productUrl = ProductUrl::query()->updateOrCreate($attributes, $values);
        return new ProductUrlDto($productUrl->toArray());
    }
}

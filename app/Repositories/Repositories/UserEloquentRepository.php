<?php

namespace App\Repositories\Repositories;

use App\Dto\UserDto;
use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Database\Eloquent\Builder;

class UserEloquentRepository implements UserRepository
{
    private const int CACHE_TTL = 60 * 60 * 24; // 24 hours

    public function getUserByEmail(string $email): UserDto
    {
        $user = cache()->remember("user_email_{$email}", self::CACHE_TTL, fn() => User::query()
            ->where('email', $email)
            ->firstOrFail()
        );

        return new UserDto($user->toArray());
    }

    public function getUserById(int $id): UserDto
    {
        $user = $this->find($id)->toArray();

        return new UserDto($user);
    }

    public function find(int $id, ?string $withRelation = null, array $columns = ['*']): User
    {
        return cache()->remember("user_id_{$id}", self::CACHE_TTL, fn() => User::query()
            ->when($withRelation, fn(Builder $query) => $query->with($withRelation))
            ->findOrFail($id, $columns));
    }
}

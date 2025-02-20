<?php

namespace App\Models;

use App\Enums\ProductUrlShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductUrl extends Model
{
    protected $fillable = ['url', 'name', 'price', 'shop'];

    protected function casts(): array
    {
        return [
            'shop' => ProductUrlShop::class,
        ];
    }

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'product_url_user', 'product_url_id', 'user_id')
            ->as('subscription')
            ->withTimestamps();
    }
}

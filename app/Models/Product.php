<?php

namespace App\Models;

use App\Enums\Region;
use App\Enums\Platform;
use App\Enums\ProductType;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'images',
        'type',
        'platform',
        'region',
        'price',
        'rating',
        'visibility',
        'discount_id'
    ];

    protected $casts = [
        'region' => Region::class,
        'type' => ProductType::class,
        'platform' => Platform::class
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_in_category', 'product_id', 'category_id');
    }

    public function shoppingCarts(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'shopping_cart', 'product_id', 'user_id')->withPivot('quantity');
    }

    public function wishlists(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'wishlist', 'product_id', 'user_id');
    }

    public function productKeys(): HasMany
    {
        return $this->hasMany(ProductKey::class, 'product_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class, 'discount_id');
    }
}

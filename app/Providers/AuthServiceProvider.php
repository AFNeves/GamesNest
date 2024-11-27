<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use App\Models\Discount;
use App\Models\Category;
use App\Models\ProductKey as Key;

use App\Policies\KeyPolicy;
use App\Policies\UserPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ReviewPolicy;
use App\Policies\ProductPolicy;
use App\Policies\DiscountPolicy;
use App\Policies\CategoryPolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Key::class => KeyPolicy::class,
        User::class => UserPolicy::class,
        Order::class => OrderPolicy::class,
        Review::class => ReviewPolicy::class,
        Product::class => ProductPolicy::class,
        Discount::class => DiscountPolicy::class,
        Category::class => CategoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}

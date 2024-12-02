<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ShopCartPolicy
{
    /**
     * Shows the shopping cart page.
     */
    public function show(User $user): bool
    {
        return Auth::check() && (Auth::user()->is_admin || Auth::id() === $user->id);
    }

    /**
     * Inserts a new product into the shopping cart.
     */
    public function store(User $user): bool
    {
        return Auth::check() && (Auth::user()->is_admin || Auth::id() === $user->id);
    }

    /**
     * Updates the quantity of a product in the shopping cart.
     */
    public function update(User $user): bool
    {
        return Auth::check() && (Auth::user()->is_admin || Auth::id() === $user->id);
    }

    /**
     * Deletes an item from the shopping cart.
     */
    public function destroy(User $user): bool
    {
        return Auth::check() && (Auth::user()->is_admin || Auth::id() === $user->id);
    }
}

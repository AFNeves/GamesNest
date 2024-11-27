<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DiscountPolicy
{
    /**
     * Fetches a discount.
     */
    public function fetch(User $user): bool
    {
        return true;
    }

    /**
     * Lists all discounts.
     */
    public function list(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Shows the create discount widget.
     */
    public function create(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Shows the edit discount widget.
     */
    public function edit(User $user ): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Inserts a new discount.
     */
    public function store(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Updates a discount.
     */
    public function update(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Deletes a discount.
     */
    public function destroy(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PromotionPolicy
{
    /**
     * Show the promotion page for a given id.
     */
    public function show(User $user): bool
    {
        return true;
    }

    /**
     * Shows the promotion of a given user for a given product.
     */
    public function list(User $user): bool
    {
        return true;
    }

    /**
     * Shows the create promotion widget.
     */
    public function create(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Shows the edit promotion widget.
     */
    public function edit(User $user ): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Inserts a new promotion.
     */
    public function store(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Updates a promotion.
     */
    public function update(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Deletes a promotion.
     */
    public function destroy(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    /**
     * Store a new user directly with the provided data.
     */
    public function storeDirect(User $user): bool
    {
        return true;
    }

    /**
     * Shows the user management page.
     */
    public function manage(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Shows the user of a given user for a given product.
     */
    public function index(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Shows the user of a given user for a given product.
     */
    public function show(User $user): bool
    {
        return $user->is_admin || $user->id === Auth::id();
    }

    /**
     * Shows the edit user widget.
     */
    public function edit(User $user): bool
    {
        return $user->is_admin || $user->id === Auth::id();
    }

    /**
     * Updates a user.
     */
    public function update(User $user): bool
    {
        return $user->is_admin || $user->id === Auth::id();
    }

    /**
     * Deletes a user.
     */
    public function destroy(User $user): bool
    {
        return $user->is_admin || $user->id === Auth::id();
    }
}

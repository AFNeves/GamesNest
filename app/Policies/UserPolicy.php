<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    /**
     * Shows the user management page.
     */
    public function manage(User $authed, User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Shows the user of a given user for a given product.
     */
    public function index(User $authed, User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Shows the user of a given user for a given product.
     */
    public function show(User $authed, User $user): bool
    {
        return (Auth::check() && Auth::user()->is_admin) || $user->id === Auth::id();
    }

    /**
     * Shows the edit user widget.
     */
    public function edit(User $authed, User $user): bool
    {
        return (Auth::check() && Auth::user()->is_admin) || $user->id === Auth::id();
    }

    /**
     * Updates a user.
     */
    public function update(User $authed, User $user): bool
    {
        return (Auth::check() && Auth::user()->is_admin) || $user->id === Auth::id();
    }

    /**
     * Deletes a user.
     */
    public function destroy(User $authed, User $user): bool
    {
        return (Auth::check() && Auth::user()->is_admin) || $user->id === Auth::id();
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Shows the user management page.
     */
    public function dashboard(User $authed, User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

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

    public function block(User $authed, User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin && !$user->is_admin;
    }

    /**
     * Deletes a user.
     */
    public function destroy(User $authed, User $user): bool
    {
        return (Auth::check() && Auth::user()->is_admin) || $user->id === Auth::id();
    }
}

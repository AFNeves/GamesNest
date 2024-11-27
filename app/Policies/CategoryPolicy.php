<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CategoryPolicy
{
    /**
     * Shows the first 5 categories using pagination.
     */
    public function index(User $user): bool
    {
        return true;
    }

    /**
     * Shows the category of a given user for a given product.
     */
    public function list(User $user): bool
    {
        return true;
    }

    /**
     * Show the category page for a given id.
     */
    public function show(User $user): bool
    {
        return true;
    }

    /**
     * Shows the create category widget.
     */
    public function create(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Shows the edit category widget.
     */
    public function edit(User $user ): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Inserts a new category.
     */
    public function store(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Updates a category.
     */
    public function update(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Deletes a category.
     */
    public function destroy(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }
}

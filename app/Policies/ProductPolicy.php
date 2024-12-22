<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Shows the first 10 products using pagination.
     */
    public function index(User $user): bool
    {
        return true;
    }

    /**
     * Shows the product page with the given id.
     */
    public function show(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Performs a full-text search.
     */
    public function ftsearch(User $user): bool
    {
        return true;
    }

    /**
     * Shows the create product widget.
     */
    public function create(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Shows the edit product widget.
     */
    public function edit(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Inserts a new product.
     */
    public function store(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Updates a product.
     */
    public function update(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Toggles a product visibility.
     */
    public function visible(User $authed): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }
}

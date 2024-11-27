<?php

namespace App\Policies;

use App\Models\User;

class ProductPolicy
{
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
        return true;
    }

    /**
     * Searches for exact matches and redirects otherwise.
     */
    public function search(User $user): bool
    {
        return true;
    }

    /**
     * Performs a full-text search.
     */
    public function ftsearch(User $user): bool
    {
        return true;
    }

    /**
     * Shows the results of full text search.
     */
    public function display(User $user): bool
    {
        return true;
    }

    /**
     * Shows the create product widget.
     */
    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Shows the edit product widget.
     */
    public function edit(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Inserts a new product.
     */
    public function store(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Updates a product.
     */
    public function update(User $user): bool
    {
        return $user->is_admin;
    }
}

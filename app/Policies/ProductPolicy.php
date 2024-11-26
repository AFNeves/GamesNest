<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;

class ProductPolicy
{
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
     * Displays the search results.
     */
    public function display(User $user): bool
    {
        return true;
    }

    /**
     * Shows the create product widget.
     */
    public function create(User $user, Product $product): bool
    {
        return $user->is_admin;
    }

    /**
     * Shows the edit product widget.
     */
    public function edit(User $user, Product $product): bool
    {
        return $user->is_admin;
    }

    /**
     * Inserts a new product.
     */
    public function store(User $user, Product $product): bool
    {
        return $user->is_admin;
    }

    /**
     * Updates a product.
     */
    public function update(User $user, Product $product): bool
    {;
        return $user->is_admin;
    }
}

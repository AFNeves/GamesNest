<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Review;

class ReviewPolicy
{
    /**
     * Shows the first 5 reviews using pagination.
     */
    public function index(User $user): bool
    {
        return true;
    }

    /**
     * Shows the review of a given user for a given product.
     */
    public function userReview(User $user, Review $review): bool
    {
        if ($user->id === $review->user_id) { return true; }
        return $user->is_admin;
    }

    /**
     * Shows the create review widget.
     */
    public function create(User $user, Review $review): bool
    {
        return !($user->is_admin);
    }

    /**
     * Shows the edit review widget.
     */
    public function edit(User $user , Review $review): bool
    {
        if ($user->id === $review->user_id) { return true; }
        return $user->is_admin;
    }

    /**
     * Inserts a new review.
     */
    public function store(User $user, Review $review): bool
    {
        return !($user->is_admin);
    }

    /**
     * Updates a review.
     */
    public function update(User $user, Review $review): bool
    {
        if ($user->id === $review->user_id) { return true; }
        return $user->is_admin;
    }

    /**
     * Deletes a review.
     */
    public function destroy(User $user, Review $review): bool
    {
        if ($user->id === $review->user_id) { return true; }
        return $user->is_admin;
    }
}

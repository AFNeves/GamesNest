<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;


class ReviewPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

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
        return (Auth::check() && Auth::user()->is_admin) || $user->id === $review->user_id;
    }

    /**
     * Shows the create review widget.
     */
    public function create(User $user, Review $review): bool
    {
        return true;
    }

    /**
     * Shows the edit review widget.
     */
    public function edit(User $user , Review $review): bool
    {
        return (Auth::check() && Auth::user()->is_admin) || $user->id === $review->user_id;
    }

    /**
     * Inserts a new review.
     */
    public function store(User $user): bool
    {
        return Auth::check();
    }
    
    /**
     * Updates a review.
     */
    public function update(User $user, Review $review): bool
    {
        return (Auth::check() && Auth::user()->is_admin) || $user->id === $review->user_id;
    }

    /**
     * Deletes a review.
     */
    public function destroy(User $user, Review $review): bool
    {
        return (Auth::check() && Auth::user()->is_admin)|| $user->id === $review->user_id;
    }
}

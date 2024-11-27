<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationPolicy
{
    /**
     * Shows the notification of a given user for a given product.
     */
    public function list(User $user): bool
    {
        return Auth::user()->is_admin;
    }

    /**
     * Show the notification page for a given id.
     */
    public function show(User $user): bool
    {
        return true;
    }

    /**
     * Shows the create notification widget.
     */
    public function create(User $user): bool
    {
        return Auth::user()->is_admin;
    }

    /**
     * Shows the edit notification widget.
     */
    public function edit(User $user ): bool
    {
        return Auth::user()->is_admin;
    }

    /**
     * Inserts a new notification.
     */
    public function store(User $user): bool
    {
        return Auth::user()->is_admin;
    }

    /**
     * Updates a notification.
     */
    public function update(User $user): bool
    {
        return Auth::user()->is_admin;
    }

    /**
     * Deletes a notification.
     */
    public function destroy(User $user): bool
    {
        return Auth::user()->is_admin;
    }
}

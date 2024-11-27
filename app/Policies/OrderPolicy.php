<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class OrderPolicy
{
    /**
     * Fetches an order.
     */
    public function details(User $user, Order $order): bool
    {
        return (Auth::check() && Auth::user()->is_admin) || $order->user_id === $user->id;
    }

    /**
     * Shows the users last order.
     */
    public function lastOrder(User $user, Order $order): bool
    {
        return (Auth::check() && Auth::user()->is_admin) || $order->user_id === $user->id;
    }

    /**
     * Shows the create order widget.
     */
    public function create(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Shows the edit order widget.
     */
    public function edit(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Inserts a new order.
     */
    public function store(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Updates an order.
     */
    public function update(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }
}

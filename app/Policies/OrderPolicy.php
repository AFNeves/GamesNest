<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Shows the details of an order.
     */
    public function show(User $user, Order $order): bool
    {
        return Auth::check() && (Auth::user()->is_admin || $order->user_id === Auth::id());
    }

    /**
     * Lists all orders.
     */
    public function listUserOrders(User $user): bool
    {
        return Auth::check() && (Auth::user()->is_admin || Auth::id() === $user->id);
    }

    /**
     * Shows the create order widget.
     */
    public function create(User $user): bool
    {
        return Auth::check() && !(Auth::user()->is_admin) && ($user->shoppingCart()->count() > 0);
    }

    /**
     * Inserts a new order.
     */
    public function store(User $user): bool
    {
        return Auth::check() && !(Auth::user()->is_admin) && ($user->shoppingCart()->count() > 0);
    }

    public function confirm(User $user, Order $order): bool
    {
        return Auth::check() && !(Auth::user()->is_admin) && ($user->id == Auth::id());
    }

    public function cancel(User $user, Order $order): bool
    {
        return Auth::check() && !(Auth::user()->is_admin) && ($user->id == Auth::id());
    }
}

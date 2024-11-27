<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class PaymentMethodPolicy
{
    /**
     * Fetches a payment method.
     */
    public function fetch(User $user, PaymentMethod $payment): bool
    {
        return (Auth::check() && Auth::user()->is_admin) || $user->id === $payment->user_id;
    }

    /**
     * Shows the all payment method for a given user.
     */
    public function listUserPaymentMethods(User $user, Collection $payments): bool
    {
        $flag = true;
        for ($i = 0; $i < $payments->count(); $i++) {
            if ($payments[$i]->user_id !== $user->id) {
                $flag = false;
            }
        }
        return (Auth::check() && Auth::user()->is_admin) || $flag;
    }

    /**
     * Shows the create payment method widget.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Shows the edit payment method widget.
     */
    public function edit(User $user, PaymentMethod $payment): bool
    {
        return (Auth::check() && Auth::user()->is_admin) || $user->id === $payment->user_id;
    }

    /**
     * Inserts a new payment method.
     */
    public function store(User $user): bool
    {
        return true;
    }

    /**
     * Updates a payment method.
     */
    public function update(User $user, PaymentMethod $payment): bool
    {
        return (Auth::check() && Auth::user()->is_admin) || $user->id === $payment->user_id;
    }

    /**
     * Deletes a payment method.
     */
    public function destroy(User $user, PaymentMethod $payment): bool
    {
        return (Auth::check() && Auth::user()->is_admin) || $user->id === $payment->user_id;
    }
}

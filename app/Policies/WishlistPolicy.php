<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;


class WishlistPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function show($user):bool{
        return Auth::check() && (Auth::user()->is_admin || Auth::id() === $user->id);
    }

    public function store(User $user): bool
    {
        return Auth::check() && (Auth::user()->is_admin || Auth::id() === $user->id);
    }

    public function destroy(User $user): bool
    {
        return Auth::check() && (Auth::user()->is_admin || Auth::id() === $user->id);
    }
}
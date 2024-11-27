<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProductKey as Key;
use Illuminate\Support\Facades\Auth;

class KeyPolicy
{
    /**
     * Shows the key with the given id.
     */
    public function fetch(User $user, Key $key): bool
    {
        $keys = $user->productKeys();

        for ($i = 0; $i < $keys->count(); $i++) {
            if ($keys[$i] == $key) {
                return true;
            }
        }

        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Shows the keys of a given user.
     */
    public function listUserKeys(User $user): bool
    {
        return true;
    }

    /**
     * Shows the create key widget.
     */
    public function create(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Shows the edit key widget.
     */
    public function edit(User $user ): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Inserts a new key.
     */
    public function store(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Updates a key.
     */
    public function update(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Deletes a key.
     */
    public function destroy(User $user): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class TransactionPolicy
{
    /**
     * Fetches a transaction.
     */
    public function fetch(User $user, Transaction $transaction): bool
    {
        return Auth::user()->is_admin || $transaction->user_id === Auth::user()->id;
    }

    /**
     * Shows the all transaction for a given user.
     */
    public function listUserTransactions(User $user, Collection $transactions): bool
    {
        $flag = true;
        for ($i = 0; $i < $transactions->count(); $i++) {
            if ($transactions[$i]->user_id !== $user->id) {
                $flag = false;
            }
        }
        return Auth::user()->is_admin || $flag;
    }

    /**
     * Shows the create transaction widget.
     */
    public function create(User $user): bool
    {
        return Auth::user()->is_admin;
    }

    /**
     * Shows the edit transaction widget.
     */
    public function edit(User $user): bool
    {
        return Auth::user()->is_admin;
    }

    /**
     * Inserts a new transaction.
     */
    public function store(User $user): bool
    {
        return Auth::user()->is_admin;
    }

    /**
     * Updates an transaction.
     */
    public function update(User $user): bool
    {
        return Auth::user()->is_admin;
    }
    
    /**
     * Deletes an transaction.
     */
    public function delete(User $user): bool
    {
        return Auth::user()->is_admin;
    }
}

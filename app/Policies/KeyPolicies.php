<?php
namespace App\Policies;

use App\Models\ProductKey;
class KeyPolicies{
    public function __construct(){
    }

    public function list(User $user, string $id)
    {
        return $user->id === $id;
    }
}
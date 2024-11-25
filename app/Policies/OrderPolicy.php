<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderPolicy{

    public function __construct(){
    }

    public function list(User $user,string $id){
        return $user->id === $id;
    }

    public function details(User $user,string $id){
        return ($user->id === $id or Auth::user()->is_admin);
    }
}
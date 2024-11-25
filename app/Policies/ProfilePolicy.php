<?php

namespace App\Policies;
use App\Models\User;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfilePolicy{
    public function __construct(){
    }

    public function show(User $user, string $id){
        return ($user->id === $id or Auth::user()->is_admin);
    }

    public function edit_profile(User $user,string $id){
        return ($user->id === $id or Auth::user()->is_admin);
    }

    public function update_profile(User $user,Request $request,string $id){
        return ($user->id === $id or Auth::user()->is_admin);
    }

}
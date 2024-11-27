@extends('layouts.app')

@section('content')
    <div class="flex flex-col flex-grow space-y-8">
        <div class="flex justify-center items-center">
            <img src="{{ asset("/images/users/" . Auth::id() . "/" . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->username }} Avatar" class="w-32 h-32 rounded-full">
        </div>

        <span>{{ Auth::user()->username }}</span>
        <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
        <span>{{ Auth::user()->email }}</span>

        <hr>

        <a href="{{ route('profile.edit', ['id' => Auth::user()->id]) }}" class="hover:underline">Edit Profile</a>
        <a href="{{ route('order.history', ['id' => Auth::user()->id]) }}" class="hover:underline">Orders History</a>
        <a href="{{ route('key.inventory', ['id' => Auth::user()->id]) }}" class="hover:underline">Key Inventory</a>
        <a href="{{ route('logout') }}" class="hover:underline">Logout</a>

        <hr>

        <a href="{{ route('profile.destroy', ['id' => Auth::user()->id]) }}" class="text-red-700 hover:underline">Delete Account</a>
    </div>
@endsection

@extends('layouts.app')

@section('header-context')
    <div class="flex items-center justify-between">
        <a href="{{ route('logout') }}" class="header-button">Logout</a>
    </div>
@endsection

@section('content')
    <div class="flex flex-col flex-grow space-y-8">
        <div class="flex justify-center items-center">
            <img src="{{ asset("/images/users/" . $user->id . "/" . $user->profile_picture) }}" alt="{{ $user->username }} Avatar" class="w-32 h-32 rounded-full">
        </div>

        <span>{{ $user->username }}</span>
        <span>{{ $user->first_name }} {{ $user->last_name }}</span>
        <span>{{ $user->email }}</span>

        <hr>

        <a href="{{ route('profile.edit', ['id' => $user->id]) }}" class="hover:underline">Edit Profile</a>

        @if ($user->is_admin)
            <a href="{{ route('management') }}" class="text-blue-500 hover:underline">User Management</a>
        @else
            <a href="{{ route('order.history', ['id' => $user->id]) }}" class="hover:underline">Orders History</a>
            <a href="{{ route('key.inventory', ['id' => $user->id]) }}" class="hover:underline">Key Inventory</a>
        @endif

        <hr>

        <a href="{{ route('profile.destroy', ['id' => $user->id]) }}" class="text-red-700 hover:underline">Delete Account</a>
    </div>
@endsection

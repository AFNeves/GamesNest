@extends('layouts.app')

@section('search-bar')
    @include('widgets.header.search-bar')
@endsection

@section('header-options')
    @include('widgets.header.header-options')
@endsection

@section('footer-logo')
    @include('widgets.footer.footer-logo')
@endsection

@section('footer-nav')
    @include('widgets.footer.footer-nav')
@endsection

@section('content')
    <div class="profile-div">
        <div class="flex justify-center items-center">
            <img src="{{ asset("/images/users/" . $user->id . "/" . $user->profile_picture) }}" alt="" class="profile-icon">
        </div>

        <div class="flex flex-col justify-center space-y-6">
            <span>{{ $user->first_name }} {{ $user->last_name }}</span>
            <span>{{ $user->username }}</span>
            <span>{{ $user->email }}</span>
        </div>

        <hr>

        <div class="flex flex-col justify-center space-y-6">
            <a href="{{ route('profile.edit', ['id' => $user->id]) }}">Edit Profile</a>

            @if ($user->is_admin)
                <a href="{{ route('admin') }}">Admin Dashboard</a>
            @else
                <a href="{{ route('order.history', ['id' => $user->id]) }}">Orders History</a>
                <a href="{{ route('key.inventory', ['id' => $user->id]) }}">Key Inventory</a>
            @endif
        </div>

        <hr>

        <form action="{{ route('profile.destroy', ['id' => $user->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="custom-button h-[50px] w-full">Delete Account</button>
        </form>
    </div>
@endsection

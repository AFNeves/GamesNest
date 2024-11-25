
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{$user->username}}</h1>
        <img src="{{ asset($user->profile_picture) }}" alt="Default Image">
        <p>Name: {{ $user->first_name}} {{ $user->last_name}}</p>
        <p>Email: {{ $user->email }}</p>
        <p><a href="{{ route('profile.edit', ['id' => $user->id]) }}" class="button button-outline">Edit Profile</a></p>
        <p><a href="{{ route('ordershistory', ['id' => $user->id]) }}" class="button button-outline">Orders History</a></p>
        <p><a href="{{ route('keysiventory', ['id' => $user->id]) }}" class="button button-outline">Key Inventory</a></p>
    </div>
@endsection
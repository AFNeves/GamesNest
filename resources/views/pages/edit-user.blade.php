@extends('layouts.app')

@section('header-context')
    @include('components.header-context')
@endsection

@section('content')
    <form method="POST" action="{{ route('profile.update', ['id' => $user->id]) }}" enctype="multipart/form-data"
        class="auth-form w-full max-w-[520px] p-4">

        @csrf
        <input id="profile-picture-input" type="file" name="profile_picture" class="hidden" />

        <div class="flex flex-col flex-grow justify-center items-center w-full space-y-8">
            <div id="profile-picture-container" class="relative w-64 h-64 rounded-full cursor-pointer">
                <img id="profile-picture" src="{{ asset("/images/users/" . Auth::id() . "/" . Auth::user()->profile_picture) }}"  alt="{{ Auth::user()->username }}" class="w-full h-full rounded-full"/>
                <div id="profile-picture-overlay" class="absolute inset-0 flex justify-center items-center bg-black bg-opacity-80 rounded-full opacity-0 hover:opacity-100 transition-opacity duration-300">
                    <img src="{{ asset('/images/icons/edit.svg') }}" alt="Logo" class="w-16 h-16"/>
                </div>
            </div>

            <div class="flex flex-col justify-between items-center space-y-8 w-full">
                <div class="flex justify-between w-full space-x-4">
                    <input type="text" name="first_name" class="auth-form-input" placeholder="First Name" value="{{ old('first_name', $user->first_name) }}" />

                    <input type="text" name="last_name" class="auth-form-input" placeholder="Last Name" value="{{ old('last_name', $user->last_name) }}" />
                </div>

                <input type="text" name="username" class="auth-form-input" placeholder="Username" value="{{ old('username', $user->username) }}" />

                <input type="email" name="email" class="auth-form-input" placeholder="Email" value="{{ old('email', $user->email) }}" />

                <input type="password" name="password" class="auth-form-input" placeholder="Password" autocomplete="new-password" />

                <input type="password" name="password_confirmation" class="auth-form-input" placeholder="Confirm Password" />
            </div>

            <div class="flex justify-between items-center w-full space-x-4">
                <button type="submit" class="auth-form-button">Save</button>
                <button type="reset" class="auth-form-button">Reset</button>
            </div>

            @if ($errors->any())
                <div class="text-red-500 text-base mt-8">
                    {{ $errors->first() }}
                </div>
            @endif
        </div>
    </form>
@endsection

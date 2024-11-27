@extends('layouts.app')

@section('header-context')
    @include('components.header-context')
@endsection

@section('content')
    <div class="flex flex-col flex-grow items-center justify-center py-4 w-full max-w-[calc(50%)]">
        <form method="POST" action="{{ route('profile.update', ['id' => $user->id]) }}" class="auth-form w-2/3 p-4">
            @csrf

            <div class="space-y-6 whitespace-nowrap w-full">
                <input type="text" name="first_name" class="auth-form-input" placeholder="First Name" value="{{ old('first_name', $user->first_name) }}" />

                <input type="text" name="last_name" class="auth-form-input" placeholder="Last Name" value="{{ old('last_name', $user->last_name) }}" />

                <input type="text" name="username" class="auth-form-input" placeholder="Username" value="{{ old('username', $user->username) }}" />

                <input type="email" name="email" class="auth-form-input" placeholder="Email" value="{{ old('email', $user->email) }}" />

                <input type="password" name="password" class="auth-form-input" placeholder="Password" />

                <input type="password" name="password_confirmation" class="auth-form-input" placeholder="Confirm Password" />
            </div>

            <button type="submit" class="auth-form-button mt-10">Save</button>

            @if ($errors->any())
                <div class="text-red-500 text-base mt-8">
                    {{ $errors->first() }}
                </div>
            @endif
        </form>
    </div>
@endsection

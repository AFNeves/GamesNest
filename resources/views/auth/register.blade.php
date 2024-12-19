@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('register-action') }}" class="auth-form">
        @csrf

        <div class="flex-col center w-full space-y-6">
            <input type="text" name="first_name" class="auth-form-input" placeholder="First Name" value="{{ old('first_name') }}" required />

            <input type="text" name="last_name" class="auth-form-input" placeholder="Last Name" value="{{ old('last_name') }}" required />

            <input type="text" name="username" class="auth-form-input" placeholder="Username" value="{{ old('username') }}" required />

            <input type="email" name="email" class="auth-form-input" placeholder="Email" value="{{ old('email') }}" required />

            <input type="password" name="password" class="auth-form-input" placeholder="Password" autocomplete="new-password" required />

            <input type="password" name="password_confirmation" class="auth-form-input" placeholder="Confirm Password" required />
        </div>

        @if ($errors->any())
            <<div class="text-red-600 text-base mt-6">
                {{ $errors->first() }}
            </div>
        @endif

        <button type="submit" class="auth-form-button @if($errors->any()) mt-6 @else mt-8 @endif">Register</button>

        <a href="{{ route('login') }}" class="text-lg hover:text-primary mt-6 cst-tr">Already have an account?</a>
    </form>
@endsection

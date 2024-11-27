@extends('layouts.app')

@section('content')
    <div class="flex flex-col flex-grow items-center justify-center py-4 w-full max-w-[calc(50%)]">
        <form method="POST" action="{{ route('register-action') }}" class="auth-form w-2/3 p-4">
            @csrf

            <div class="space-y-6 whitespace-nowrap w-full">
                <input type="text" name="first_name" class="auth-form-input" placeholder="First Name" value="{{ old('first_name') }}" required />

                <input type="text" name="last_name" class="auth-form-input" placeholder="Last Name" value="{{ old('last_name') }}" required />

                <input type="text" name="username" class="auth-form-input" placeholder="Username" value="{{ old('username') }}" required />

                <input type="email" name="email" class="auth-form-input" placeholder="Email" value="{{ old('email') }}" required />

                <input type="password" name="password" class="auth-form-input" placeholder="Password" required />

                <input type="password" name="password_confirmation" class="auth-form-input" placeholder="Confirm Password" required />
            </div>

            <button type="submit" class="auth-form-button mt-10">Register</button>

            @if ($errors->any())
                <div class="text-red-500 text-base mt-8">
                    {{ $errors->first() }}
                </div>
            @endif

            <a href="{{ route('login') }}" class="text-lg text-gray-300 mt-10">Already have an account?</a>
        </form>
    </div>
@endsection

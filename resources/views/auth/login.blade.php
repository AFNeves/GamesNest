@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('login-action') }}" class="auth-form">
        @csrf

        <div class="flex-col center w-full space-y-6">
            <input type="text" name="username" class="auth-form-input" placeholder="Email" value="{{ old('email') }}" required />

            <input type="password" name="password" class="auth-form-input" placeholder="Password" required />
        </div>

        @if ($errors->any())
            <div class="text-red-600 text-base mt-6">
                {{ $errors->first() }}
            </div>
        @endif

        <button type="submit" class="auth-form-button @if($errors->any()) mt-6 @else mt-8 @endif">Login</button>

        <div class="flex justify-between mt-6">
            <a href="{{ route('register') }}" class="text-lg hover:text-primary cst-tr">Don't have an account? Let's fix that!</a>
        </div>

        <a href="{{ route('password-reset') }}" class="text-lg text-blue-500 hover:text-blue-700 mt-4 inline-block">Forgot your password?</a>
    </form>
@endsection

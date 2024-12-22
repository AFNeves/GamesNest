@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('password.update') }}" class="auth-form">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="flex-col center w-full space-y-6">
            <input 
                type="password" 
                name="password" 
                class="auth-form-input" 
                placeholder="Enter new password" 
                required 
            />

            <input 
                type="password" 
                name="password_confirmation" 
                class="auth-form-input" 
                placeholder="Confirm new password" 
                required 
            />
        </div>

        <button type="submit" class="auth-form-button mt-8">
            Reset Password
        </button>
    </form>
@endsection

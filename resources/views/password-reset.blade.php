@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('password-reset') }}" class="auth-form">
        @csrf

        <div class="flex-col center w-full space-y-6">
            <input 
                type="email" 
                name="email" 
                class="auth-form-input" 
                placeholder="Enter your email" 
                value="{{ old('email') }}" 
                required 
            />
        </div>

        @if ($errors->any())
            <div class="text-red-600 text-base mt-6">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('status'))
            <div class="text-green-600 text-base mt-6">
                {{ session('status') }}
            </div>
        @endif

        <button type="submit" class="auth-form-button @if($errors->any() || session('status')) mt-6 @else mt-8 @endif">
            Send Recovery Link
        </button>

        <a href="{{ route('login') }}" class="text-lg hover:text-primary mt-6 cst-tr">
            Back to Login
        </a>
    </form>
@endsection

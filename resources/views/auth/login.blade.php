@extends('layouts.app')

@section('content')
    <div class="flex flex-col flex-grow items-center justify-center py-4 w-full max-w-[calc(50%)]">
        <form method="POST" action="{{ route('login-action') }}" class="auth-form w-2/3 p-4 space-y-10">
            @csrf

            <div class="space-y-8 whitespace-nowrap w-full">
                <input type="email" name="email" class="auth-form-input" placeholder="Email" value="{{ old('email') }}" required />

                <input type="password" name="password" class="auth-form-input" placeholder="Password" required />
            </div>

            {{-- TODO: PA Delivery
            <div class="flex items-center justify-start w-full">
                <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" />
                <label for="remember" class="ms-2 text-base text-gray-800 dark:text-gray-300">Remember me</label>
            </div>
            --}}

            <button type="submit" class="auth-form-button">Login</button>

            @if ($errors->any())
                <div class="text-red-500 text-base m-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <a href="{{ route('register') }}" class="text-lg text-gray-300 mb-8">Don't have an account? Let's fix that!</a>
        </form>
    </div>
@endsection

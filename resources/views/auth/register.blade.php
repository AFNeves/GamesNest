@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Register</h2>

    <!-- Display global errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf <!-- CSRF Token -->

        <!-- First Name -->
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input id="first_name" type="text" 
                   class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" 
                   name="first_name" value="{{ old('first_name') }}" required autofocus>
            @if ($errors->has('first_name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('first_name') }}</strong>
                </span>
            @endif
        </div>

        <!-- Last Name -->
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input id="last_name" type="text" 
                   class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" 
                   name="last_name" value="{{ old('last_name') }}" required>
            @if ($errors->has('last_name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
            @endif
        </div>

        <!-- Username -->
        <div class="form-group">
            <label for="username">Username</label>
            <input id="username" type="text" 
                   class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" 
                   name="username" value="{{ old('username') }}" required>
            @if ($errors->has('username'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">E-Mail Address</label>
            <input id="email" type="email" 
                   class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                   name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" 
                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                   name="password" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <!-- Password Confirmation -->
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" class="form-control" 
                   name="password_confirmation" required>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Register
            </button>
            <a class="btn btn-secondary" href="{{ route('login') }}">Login</a>
        </div>
    </form>
</div>
@endsection

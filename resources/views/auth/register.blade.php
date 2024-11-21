@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}

    <label for="firstName">First Name</label>
    <input id="firstName" type="text" name="firstName" value="{{ old('firstName') }}" required autofocus>
    @if ($errors->has('firstName'))
      <span class="error">
          {{ $errors->first('firstName') }}
      </span>
    @endif

    <label for="lastName">Last Name</label>
    <input id="lastName" type="text" name="lastName" value="{{ old('lastName') }}" required autofocus>
    @if ($errors->has('lastName'))
        <span class="error">
          {{ $errors->first('lastName') }}
      </span>
    @endif

    <label for="username">Username</label>
    <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus>
    @if ($errors->has('username'))
        <span class="error">
          {{ $errors->first('username') }}
      </span>
    @endif

    <label for="email">E-Mail Address</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
    @if ($errors->has('email'))
      <span class="error">
          {{ $errors->first('email') }}
      </span>
    @endif

    <label for="password">Password</label>
    <input id="password" type="password" name="password" required>
    @if ($errors->has('password'))
      <span class="error">
          {{ $errors->first('password') }}
      </span>
    @endif

    <label for="password-confirm">Confirm Password</label>
    <input id="password-confirm" type="password" name="password_confirmation" required>

    <button type="submit">
      Register
    </button>
    <a class="button button-outline" href="{{ route('login') }}">Login</a>
</form>
@endsection
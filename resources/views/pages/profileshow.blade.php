@extends('layouts.app')

@section('content')
    <div class="container">
        <!--
        toFix
        somethings need controlers to actually work so they are just a template rn
        also somehow display the profile picture
        -->
        <h1>UsernameTemplate{{auth()->user()->username}}</h1>

        <p>Name: FullNameTemplate {{ auth()->user()->first_name}}{{ auth()->user()->last_name}}</p>
        <p>Email: {{ auth()->user()->email }}</p>

    </div>
@endsection
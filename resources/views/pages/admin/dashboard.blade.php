@extends('layouts.app')

@section('header-options')
    @include('widgets.header.header-options')
@endsection

@section('content')
    <div class="admin-dashboard">
        <span class="">Admin Dashboard</span>

        <a href="{{ route('management') }}">User Management Page</a>

        <a href="{{ route('product.manage') }}">Product Management Page</a>
    </div>
@endsection

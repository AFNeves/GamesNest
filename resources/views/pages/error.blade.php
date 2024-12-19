@extends('layouts.app')

@section('search-bar')
    @include('widgets.header.search-bar')
@endsection

@section('header-options')
    @include('widgets.header.header-options')
@endsection

@section('content')
    <div class="center w-full flex-grow">
        <img src="{{ asset("/images/svg/$errorCode.svg") }}" alt="Error {{$errorCode}}" class="h-auto w-full max-w-[600px]"/>
    </div>
@endsection

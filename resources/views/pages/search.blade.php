@extends('layouts.app')

@section('title', 'Search')

@section('search-bar')
    @include('components.search-bar')
@endsection

@section('header-context')
    @include('components.header-context')
@endsection

@section('content')
    @if ($products->isEmpty())
        <div class="flex flex-col flex-grow items-center justify-center p-4 w-full rounded-xl space-y-4">
            <h1 class="text-4xl">No products found</h1>
        </div>
    @else
        <div class="flex flex-col flex-grow items-center justify-center mx-28">
            <div class="flex flex-col flex-grow items-center justify-start p-4 w-full bg-gray-600 rounded-xl space-y-4">
                @foreach($products as $product)
                    <a href="{{ route('product', ['id' => $product->id]) }}" class="flex w-full bg-gray-800 rounded-xl p-3">
                        <img src="{{ asset('images/games-nest-icon.png') }}" alt="{{ $product->title }}" class="w-1/4 h-1/4 rounded-l-xl">
                        <div class="flex flex-col justify-evenly ml-8">
                            <h2>{{ $product->title }}</h2>
                            <p>{{ $product->region }}</p>
                            <p>{{ $product->price }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
@endsection

@extends('layouts.app')

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
        <div class="flex flex-col flex-grow items-center justify-center w-full px-28">
            <div class="flex flex-col flex-grow items-center justify-start p-4 w-full bg-gray-600 rounded-xl space-y-4">
                @foreach($products as $product)
                    <a href="{{ route('product', ['id' => $product->id]) }}" class="flex w-full bg-gray-800 rounded-xl p-3 space-x-8">
                        <img src="{{ url($product->images . '/' . scandir($product->images)[2]) }}" alt="{{ $product->title }}" class="w-full max-w-64 h-auto rounded-lg">
                        <div class="flex flex-col flex-grow justify-evenly">
                            <h2>{{ $product->title }}</h2>
                            <span>{{ $product->region }}</span>
                            <span>{{ $product->price }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
@endsection

@extends('layouts.app')

@if ($items->isEmpty())
    @section('header-context')
        @include('components.header-context')
    @endsection

    @section('content')
        <div class="flex flex-col flex-grow items-center justify-center p-4 w-full rounded-xl space-y-4">
            <h1 class="text-4xl">No products wishlisted</h1>
        </div>
    @endsection
@else
    @section('content')
        <div class="flex flex-grow w-full space-x-4">
            <div class="flex flex-col flex-grow items-center justify-start p-4 w-full bg-gray-600 rounded-xl space-y-4">
                @foreach($items as $item)
                    <div class="flex w-full bg-gray-800 rounded-xl p-4 justify-between items-center min-h-44">
                        <img src="{{ url($item->images . '/' . scandir($item->images)[2]) }}" alt="{{ $item->title }}" class="w-auto h-full max-h-36 rounded-lg">
                        <div class="flex flex-col flex-grow justify-between mx-4 h-full p-4">
                            <span>{{ $item->title }}</span>
                            <span class="text-green-500">{{ $item->region }}</span>
                            <span>{{ $item->price }} €</span>
                        </div>
                        <form method="POST" action="{{ route('cart.store') }}" class="flex items-center space-x-4">
                            @csrf
                            <input type="hidden" name="price" value="{{ $item->price }}"    >
                            <input type="hidden" name="product_id" value="{{ $item->id }}">
                            <button type="submit" class="bg-gray-800 rounded-lg p-6">Add to Cart</button>
                        </form>
                        <div class="flex flex-col justify-evenly h-full">
                            <form action="{{ route('wishlist.destroy') }}" method="POST" class="self-center">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                <button type="submit">
                                    <img src="{{ asset('images/icons/closed_heart.svg') }}" alt="Remove from Wishlist" class="w-10 h-10">
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endsection
@endif

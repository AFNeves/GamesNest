@extends('layouts.app')

@section('search-bar')
    @include('components.search-bar')
@endsection

@section('header-context')
    @include('components.header-context')
@endsection

@section('content')
    <div class="flex flex-col flex-grow items-center justify-start p-4 w-full bg-gray-600 rounded-xl space-y-4">
        <div class="flex space-x-4">
            <div class="flex flex-col space-y-4 w-full min-w-96 max-w-96">
                <img src="{{ url($product->images . '/' . scandir($product->images)[2]) }}" alt="{{ $product->title }}" class="w-full h-auto rounded-lg">

                <div class="flex flex-grow justify-between items-center w-full space-x-4">
                    @php
                        $images = array_slice(array_diff(scandir(public_path($product->images)), array('.', '..')), 1, 4);
                    @endphp

                    @foreach($images as $image)
                        <img src="{{ url($product->images . '/' . $image) }}" alt="{{ $product->title }}" class="w-full h-auto rounded-lg">
                    @endforeach
                </div>
            </div>


            <div class="flex flex-col flex-grow">
                <div class="flex justify-between items-center py-4">
                    @if (Auth::user()->is_admin)
                        <a href="{{ route('product.edit', ['id'=>$product->id]) }}" class="py-2 mr-6">
                            <img src="{{ asset("/images/icons/edit.svg") }}" class="w-12 h-12" alt="Logout"/>
                        </a>
                    @else
                        @if($product->wishlists()->where('user_id', Auth::id())->exists())
                            <form method="POST" action="{{ route('wishlist.destroy') }}" class="flex items-center space-x-4">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button> <img src="{{ asset("/images/icons/closed_heart.svg") }}" class="w-12 h-12" alt="Remove from Wishlist"/>
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('wishlist.store') }}" class="flex items-center space-x-4">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button> <img src="{{ asset("/images/icons/open_heart.svg") }}" class="w-12 h-12" alt="Add to Wishlist"/>
                                </button>
                            </form>
                        @endif
                    @endif
                    <span class="text-3xl">{{ $product->title }}</span>
                    <form method="POST" action="{{ route('cart.store') }}" class="flex items-center space-x-4">
                        @csrf
                        <span class="text-3xl">{{ $product->price }} €</span>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="bg-gray-800 rounded-lg p-6">Add to Cart</button>
                    </form>
                </div>
                <span class="bg-gray-700 p-4 rounded-lg h-full leading-8 text-xl">{{ $product->description }}</span>
            </div>
        </div>

        <div class="flex justify-evenly items-center w-full space-x-4">
            <span class="p-6 w-96 bg-gray-800 rounded-lg text-center">{{ $product->platform }}</span>
            <span class="p-6 flex-grow bg-gray-800 rounded-lg text-center">{{ $product->region }}</span>
            <span class="p-6 flex-grow bg-gray-800 rounded-lg text-center">{{ $product->type }}</span>
        </div>

        @if($product->reviews->count() === 0)
            <div class="flex items-center justify-center w-full flex-grow">
                <h1>No Reviews Yet</h1>
            </div>
        @else
            <div class="flex flex-col justify-evenly items-center w-full space-y-4">
                @foreach($product->reviews as $review)
                    <div class="flex flex-col space-y-8 w-full bg-gray-700 rounded-lg px-6 pt-4 pb-6">
                        <div class="flex justify-between items-center">
                            <div class = "flex items-center space-x-4">
                                <img src="{{ url('images/users/' . $review->user->id . '/' . $review->user->profile_picture) }}" alt="{{ $review->user->usename }} Picture" class="w-12 h-12 rounded-full">
                                <span class="">{{ $review->user->first_name }} {{ $review->user->last_name }}</span>
                            </div>
                            <span class="">{{ $review->review_date }}</span>
                        </div>
                        <div class="space-x-4">
                            <span class="">Rating:</span>
                            <span class="rounded-lg bg-gray-800 p-2">{{ $review->rating }}</span>
                        </div>
                        <span class="pt-4">{{ $review->text }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

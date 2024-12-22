@extends('layouts.app')

@section('search-bar')
    @include('widgets.header.search-bar')
@endsection

@section('header-options')
    @include('widgets.header.header-options')
@endsection

@section('footer-logo')
    @include('widgets.footer.footer-logo')
@endsection

@section('footer-nav')
    @include('widgets.footer.footer-nav')
@endsection

@section('content')
    <div class="flex flex-col flex-grow items-center justify-start p-4 w-full bg-gray-600 rounded-xl space-y-4">
        <!-- Product Images and Info -->
        <div class="flex space-x-4">
            <div class="flex flex-col space-y-4 w-full min-w-96 max-w-96">
                <!-- Main Product Image -->
                <img src="{{ url($product->images . '/' . scandir($product->images)[2]) }}" alt="{{ $product->title }}" class="w-full h-auto rounded-lg">

                <!-- Additional Images -->
                <div class="flex flex-grow justify-between items-center w-full space-x-4">
                    @php
                        $images = array_slice(array_diff(scandir(public_path($product->images)), array('.', '..')), 1, 4);
                    @endphp
                    @foreach($images as $image)
                        <img src="{{ url($product->images . '/' . $image) }}" alt="{{ $product->title }}" class="w-full h-auto rounded-lg">
                    @endforeach
                </div>
            </div>

            <!-- Product Title, Price, and Description -->
            <div class="flex flex-col flex-grow">
                <div class="flex justify-between items-center py-4">
                    <!-- Admin Edit Button -->
                    @if (Auth::user() && Auth::user()->is_admin)
                        <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="py-2 mr-6">
                            <img src="{{ asset("/images/icons/edit.svg") }}" class="w-12 h-12" alt="Edit">
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

                    <!-- Add to Cart Form -->
                    <form method="POST" action="{{ route('cart.store') }}" class="flex items-center space-x-4">
                        @csrf
                        <span class="text-3xl">{{ $product->price }} €</span>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="bg-gray-800 rounded-lg p-6">Add to Cart</button>
                    </form>
                </div>

                <!-- Product Description -->
                <span class="bg-gray-700 p-4 rounded-lg h-full leading-8 text-xl">{{ $product->description }}</span>
            </div>
        </div>

        <!-- Product Metadata -->
        <div class="flex justify-evenly items-center w-full space-x-4">
            <span class="p-6 w-96 bg-gray-800 rounded-lg text-center">{{ $product->platform }}</span>
            <span class="p-6 flex-grow bg-gray-800 rounded-lg text-center">{{ $product->region }}</span>
            <span class="p-6 flex-grow bg-gray-800 rounded-lg text-center">{{ $product->type }}</span>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Reviews Section -->
        @if($product->reviews->count() === 0)
            <div class="flex items-center justify-center w-full flex-grow">
                <h1>No Reviews Yet</h1>
            </div>
        @else
            <div class="flex flex-col justify-evenly items-center w-full space-y-4">
                @foreach($product->reviews->sortByDesc('review_date') as $review)
                    <div class="flex flex-col space-y-8 w-full bg-gray-700 rounded-lg px-6 pt-4 pb-6">
                        <!-- Review Header -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                <img src="{{ url('images/users/' . $review->user->id . '/' . $review->user->profile_picture) }}" alt="{{ $review->user->username }} Picture" class="w-12 h-12 rounded-full">
                                <span>{{ $review->user->first_name }} {{ $review->user->last_name }}</span>
                            </div>
                            <span>{{ $review->review_date->format('d-m-Y') }}</span>
                        </div>

                        <!-- Review Rating -->
                        <div class="space-x-4">
                            <span>Rating:</span>
                            <span class="rounded-lg bg-gray-800 p-2">{{ $review->rating }}</span>
                        </div>

                        <!-- Review Text -->
                        <span class="pt-4">{{ $review->text }}</span>

                        <!-- Edit/Delete Buttons -->
                        @if(auth()->id() === $review->user_id)
                            <div class="flex space-x-4">
                                <form method="POST" action="{{ route('review.destroy', $review->id) }}" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white p-2 rounded-lg">Delete</button>
                                </form>
                                <a href="{{ route('review.edit', $review->id) }}" class="bg-blue-500 text-white p-2 rounded-lg">Edit</a>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        <!-- User Review Form -->
        @if(Auth::check())
            @php
                $userReview = $product->reviews->where('user_id', Auth::id())->first();
            @endphp

            @if(!$userReview)
                <!-- Form to submit a new review -->
                <form method="POST" action="{{ route('review.store') }}" class="flex flex-col space-y-4 bg-gray-700 p-6 rounded-lg w-full">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="review_date" value="{{ now() }}">

                    <textarea name="text" placeholder="Write your review here..." class="p-4 rounded-lg bg-gray-800 text-white" required></textarea>
                    <input type="number" name="rating" min="0" max="5" step="0.1" placeholder="Rating (0-5)" class="p-2 rounded-lg bg-gray-800 text-white" required>
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg">Submit Review</button>
                </form>
            @else
                <!-- Message when user has already reviewed the product -->
                <div class="p-6 bg-gray-700 rounded-lg text-white">
                    <h3>You have already reviewed this product.</h3>
                </div>
            @endif
        @endif
    </div>
@endsection

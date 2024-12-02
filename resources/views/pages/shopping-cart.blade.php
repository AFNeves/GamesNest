@extends('layouts.app')

@if ($items->isEmpty())
    @section('header-context')
        @include('components.header-context')
    @endsection

    @section('content')
        <div class="flex flex-col flex-grow items-center justify-center p-4 w-full rounded-xl space-y-4">
            <h1 class="text-4xl">No products in cart</h1>
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
                        <div class="flex flex-col justify-evenly h-full">
                            <form action="{{ route('cart.destroy') }}" method="POST" class="self-center">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                <button type="submit">
                                    <img src="{{ asset('images/icons/trash.svg') }}" alt="Remove from Cart" class="w-10 h-10">
                                </button>
                            </form>
                            <div class="flex items-center justify-center bg-gray-500 rounded-lg py-1">
                                <div class="w-1/4 h-auto">
                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                                        <input type="hidden" name="quantity" value="{{ $item->pivot->quantity - 1 }}">
                                        <button type="submit" @if($item->pivot->quantity <= 1) disabled @endif>
                                            <img src="{{ asset('images/icons/minus.svg') }}" alt="Decrease Quantity" class="w-10 h-10">
                                        </button>
                                    </form>
                                </div>
                                <span id="item-quantity-{{ $item->id }}" class="px-4 text-white">{{ $item->pivot->quantity }}</span>
                                <div class="w-1/4 h-auto">
                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                                        <input type="hidden" name="quantity" value="{{ $item->pivot->quantity + 1 }}">
                                        <button type="submit" @if($item->pivot->quantity > 20) disabled @endif>
                                            <img src="{{ asset('images/icons/plus.svg') }}" alt="Increase Quantity" class="w-10 h-10">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex flex-col items-center justify-between px-6 py-12 w-1/3 bg-gray-600 rounded-xl space-y-8">
                <div class="flex flex-col w-full space-y-8">
                    <span class="text-3xl self-center">Order Summary</span>
                    @foreach($items as $item)
                        <div class="flex flex-col w-full space-y-6">
                            <span class="leading-8">{{ $item->title }}</span>
                            <div class="flex justify-between">
                                <span>(x{{ $item->pivot->quantity }})</span>
                                <span>€{{ number_format($item->price * $item->pivot->quantity, 2) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex flex-col items-center justify-center w-full space-y-4">
                    <span class="text-3xl">Total: {{ $items->sum('price') }} €</span>
                    <form action="{{ route('checkout') }}" method="GET">
                        <input type="hidden" name="id" value="{{ Auth::id() }}">
                        <button type="submit" class="bg-green-500 rounded-lg p-2">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
@endif

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Shopping Cart</h1>
    
    @if($cartItems->isEmpty())
        <p>Your cart is empty</p>
    @else
        <div class="cart-items">
            @foreach($cartItems as $item)
            <div class="cart-item">
                <img src="{{ $item->images }}" alt="{{ $item->title }}">
                <div class="item-details">
                    <h3>{{ $item->title }}</h3>
                    <div class="price-section">
                        @if($item->final_price != $item->price)
                            <span class="original-price">€{{ $item->price }}</span>
                        @endif
                        <span class="final-price">€{{ $item->final_price }}</span>
                    </div>
                    
                    <div class="quantity-controls">
                        <form action="{{ route('cart.update', $item->product_id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" name="action" value="decrease">-</button>
                            <span>{{ $item->quantity }}</span>
                            <button type="submit" name="action" value="increase" 
                                    {{ $item->quantity >= $item->available_stock ? 'disabled' : '' }}>+</button>
                        </form>
                    </div>

                    <form action="{{ route('cart.remove', $item->product_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Remove</button>
                    </form>
                </div>
            </div>
            @endforeach

            <div class="cart-summary">
                <h3>Total: €{{ $cartItems->sum(function($item) { 
                    return $item->final_price * $item->quantity; 
                }) }}</h3>
                <form action="{{ route('checkout.show') }}" method="GET">
                    @csrf
                    <button type="submit">Proceed to Checkout</button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection
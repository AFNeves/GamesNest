@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>
    
    <div class="checkout-container">
        <div class="order-summary">
            <h2>Order Summary</h2>
            @foreach($cartItems as $item)
            <div class="order-item">
                <span>{{ $item->title }} (x{{ $item->quantity }})</span>
                <span>€{{ number_format($item->final_price * $item->quantity, 2) }}</span>
            </div>
            @endforeach
            
            <div class="order-total">
                <strong>Total:</strong>
                <strong>€{{ number_format($total, 2) }}</strong>
            </div>
        </div>

        <form action="{{ route('checkout.process') }}" method="POST" class="checkout-form">
            @csrf
            
            <div class="form-group">
                <label for="address">Shipping Address</label>
                <input type="text" id="address" name="address" required
                       class="form-control @error('address') is-invalid @enderror"
                       value="{{ old('address') }}">
                @error('address')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" required
                       class="form-control @error('city') is-invalid @enderror"
                       value="{{ old('city') }}">
                @error('city')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input type="text" id="postal_code" name="postal_code" required
                       class="form-control @error('postal_code') is-invalid @enderror"
                       value="{{ old('postal_code') }}">
                @error('postal_code')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Payment Method</label>
                <div class="payment-options">
                    <label>
                        <input type="radio" name="payment_method" value="credit_card" required>
                        Credit Card
                    </label>
                    <label>
                        <input type="radio" name="payment_method" value="paypal" required>
                        PayPal
                    </label>
                </div>
                @error('payment_method')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>
</div>

<style>
.checkout-container {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 2rem;
    max-width: 1200px;
    margin: 2rem auto;
}

.order-summary {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
}

.order-item {
    display: flex;
    justify-content: space-between;
    margin: 0.5rem 0;
}

.order-total {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 2px solid #dee2e6;
    display: flex;
    justify-content: space-between;
}

.checkout-form {
    padding: 1.5rem;
    border: 1px solid #dee2e6;
    border-radius: 8px;
}

.form-group {
    margin-bottom: 1rem;
}

.payment-options {
    display: flex;
    gap: 1rem;
    margin-top: 0.5rem;
}
</style>
@endsection
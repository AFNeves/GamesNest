@extends('layouts.app')

@section('content')
    <div class="flex flex-grow justify-between w-full space-x-4">
        <form action="{{ route('checkout.action') }}" method="POST" class="flex flex-col flex-grow items-center justify-start p-6 w-1/3 bg-gray-600 rounded-lg">
            @csrf

            <div class="space-y-4 whitespace-nowrap w-full mt-2">
                <span class="text-2xl px-0.5">Shipping Address</span>

                <input type="text" name="address_line" class="address-input w-full" placeholder="Address Line" value="{{ old('address_line') }}" required />

                <input type="text" name="district" class="address-input w-full" placeholder="State" value="{{ old('district') }}" required />

                <div class="flex justify-between w-full space-x-4">
                    <input type="text" name="city" class="address-input w-full" placeholder="City" value="{{ old('city') }}" required />

                    <input type="text" name="postal_code" class="address-input w-1/2" placeholder="Postal Code" value="{{ old('postal_code') }}" required />
                </div>

                <input type="text" name="country" class="address-input w-full" placeholder="Country" value="{{ old('country') }}" required />

                <input type="tel" name="phone_number" class="address-input w-full" placeholder="Phone Number" value="{{ old('phone_number') }}" required />
            </div>

            <hr>

            <div class="space-y-4 whitespace-nowrap w-full mt-6">
                <span class="text-2xl px-0.5">Payment Information</span>

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
            </div>

            @if ($errors->any())
                <div class="text-red-500 text-base m-4">
                    {{ $errors->first() }}
                </div>
            @endif
        </form>

        <div class="flex flex-col items-center justify-between px-6 py-12 w-1/3 bg-gray-600 rounded-xl space-y-8">
            <div class="flex flex-col w-full space-y-8">
                <span class="text-3xl self-center">Order Summary</span>
                @foreach($items as $item)
                    <div class="flex flex-col w-full space-y-8">
                        <span>{{ $item->title }}</span>
                        <div class="flex justify-between">
                            <span>(x{{ $item->pivot->quantity }})</span>
                            <span>€{{ number_format($item->price * $item->pivot->quantity, 2) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex flex-col items-center justify-center w-full space-y-4">
                <span class="text-3xl">Total: {{ $items->sum('price') }} €</span>
                <form action="{{ route('checkout.action') }}" method="GET">
                    <input type="hidden" name="id" value="{{ Auth::id() }}">
                    <button type="submit" class="bg-green-500 rounded-lg p-2" disabled>Place Order</button>
                </form>
            </div>
        </div>
    </div>
@endsection

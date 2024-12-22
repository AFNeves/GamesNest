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
    <div class="flex flex-col flex-grow justify-center items-center space-y-4 cst-tr w-full max-w-[600px]">
        <!-- Why Choose Us Section -->
        <div class="flex flex-col justify-center items-start space-y-2">
            <span class="leading-8 text-center font-audio text-2xl mb-2">Services</span>
            <span class="leading-8 text-center text-base">
                Digital keys for games on platforms like Steam, Epic Games, and Origin.
            </span>
            <span class="leading-8 text-center text-base">
                Competitive pricing to ensure value for money.
            </span>
            <span class="leading-8 text-center text-base">
                100% Secure. All our keys are sourced directly from official publishers and developers.
            </span>
            <span class="leading-8 text-center text-base">
                Instant Delivery. Receive your game keys instantly after purchase.
            </span>
            <span class="leading-8 text-center text-base">
                24/7 Support. Our customer service team is always here to help you.
            </span>
        </div>
    </div>
@endsection

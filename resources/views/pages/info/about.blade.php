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
        <!-- Our Story Section -->
        <div class="flex flex-col justify-center space-y-4">
            <span class="leading-8 text-center font-audio text-2xl">Our Story</span>
            <span class="leading-8 text-center text-base">
                Founded in 2024, GamesNest emerged from a simple vision: to provide gamers with a reliable, secure, and affordable platform to purchase their favorite games. What started as a small venture has grown into a trusted marketplace serving thousands of satisfied customers worldwide.
            </span>
        </div>

        <!-- Our Mission Section -->
        <div class="flex flex-col justify-center space-y-4">
            <span class="leading-8 text-center font-audio text-2xl">Our Mission</span>
            <span class="leading-8 text-center text-base">
                At GamesNest, we value your gaming experience. That’s why we ensure instant delivery of your game keys, competitive pricing, and exceptional customer support to keep you playing without interruptions. Whether you’re a casual player or a hardcore gamer, GamesNest is here to make your journey smoother and more enjoyable.
            </span>
        </div>
    </div>
@endsection

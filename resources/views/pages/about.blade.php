@extends('layouts.app')

@section('content')
    <div class="flex flex-col justify-center items-center space-y-4 cst-tr w-full max-w-[600px]">
        <!-- Our Story Section -->
        <div class="flex flex-col justify-center space-y-4">
            <span class="leading-8 text-center text-2xl">Our Story</span>
            <span class="leading-8 text-center">
                Founded in 2024, GamesNest emerged from a simple vision: to provide gamers with a reliable, secure, and affordable platform to purchase their favorite games. What started as a small venture has grown into a trusted marketplace serving thousands of satisfied customers worldwide.
            </span>
        </div>

        <!-- Our Mission Section -->
        <div class="flex flex-col justify-center space-y-4">
            <span class="leading-8 text-center text-2xl">Our Mission</span>
            <span class="leading-8 text-center">
                To provide gamers with authentic game keys at competitive prices while ensuring the best possible shopping experience.
            </span>
        </div>

        <div class="flex flex-col justify-center space-y-4">
            <span class="leading-8 text-center text-2xl">Why choose us</span>
            <span class="leading-8 text-center">
                <ul>
                    <li>100% Secure. All our keys are sourced directly from official publishers and developers.</li>
                    <li>Instant Delivery. Receive your game keys instantly after purchase.</li>
                    <li>24/7 Support. Our customer service team is always here to help you.</li>
                </ul>
            </span>
        </div>

        <!-- Contact CTA Section -->
        <div class="rounded-2xl flex flex-col items-center space-y-4">
            <span class="text-lg">Have Questions?</span>
            <span class=" leading-6">We're here to help! <a href="{{ route('contact') }}" class="hover:text-primary hover:scale-105 cst-tr">Contact</a> our support team or check out our <a href="{{ route('faq') }}" class="hover:text-primary hover:scale-105 cst-tr">FAQ</a> section.</span>
        </div>
    </div>
@endsection

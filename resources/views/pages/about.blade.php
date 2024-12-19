@extends('layouts.app')

@section('content')

    <!-- Our Story Section -->
    <div class="flex flex-col justify-center space-y-4">
        <span class="leading-8 text-center" style="font-size: 1.5em;">Our Story</span>
        <span class="leading-8 text-center" style="margin-bottom:1em;">
            Founded in 2024, GamesNest emerged from a simple vision: to provide gamers with a reliable, secure, and affordable platform to purchase their favorite games. What started as a small venture has grown into a trusted marketplace serving thousands of satisfied customers worldwide.
        </span>
    </div>

    <!-- Our Mission Section -->
    <div class="flex flex-col justify-center space-y-4">
        <span class="leading-8 text-center" style="font-size: 1.5em;">Our Mission</span>
        <span class="leading-8 text-center" style="margin-bottom:1em;">
            To provide gamers with authentic game keys at competitive prices while ensuring the best possible shopping experience.
        </span>
      
    </div>

    <div class="flex flex-col justify-center space-y-4">
        <span class="leading-8 text-center" style="font-size: 1.5em;">Why choose us</span>
        <span class="leading-8 text-center" style="margin-bottom:1em;">
            <ul>
                <li>100% Secure. All our keys are sourced directly from official publishers and developers.</li>
                <li>Instant Delivery. Receive your game keys instantly after purchase.</li>
                <li>24/7 Support. Our customer service team is always here to help you.</li>
            </ul>
        </span>      
    </div>



    <!-- Contact CTA Section -->
    <div class="row py-4">
        <div class="col-12 text-center">
            <div class="bg-light p-5 rounded">
                <span class="mb-4">Have Questions?</span>
                <span class="mb-4" style="line-height: 1.4;">We're here to help! Contact our support team or check out our FAQ section.</span>
            </div>
        </div>
    </div>
</div>
@endsection


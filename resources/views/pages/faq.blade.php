@extends('layouts.app')

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
    <div class="flex flex-col items-center justify-center flex-grow p-8 w-full max-w-[600px]">
        <span class="font-audio text-2xl mb-8">Frequently Asked Questions</span>

        <div class="flex flex-col items-center flex-grow space-y-4">
            <div class="flex flex-col justify-center space-y-2 cst-tr">
                <span class="leading-8 font-audio text-center cursor-pointer cst-tr hover:text-primary hover:scale-105" onclick="toggleAnswer(this)">1. What is a game key, and how does it work?</span>
                <span class="leading-8 text-center cst-tr" style="display:none;">
                A game key is a unique code used to activate and download a digital game on platforms like Steam or Epic Games.
                </span>
            </div>

            <div class="flex flex-col space-y-2">
                <span class="leading-8 font-audio text-center cursor-pointer cst-tr hover:text-primary hover:scale-105" onclick="toggleAnswer(this)">2. Do I need an account to buy a game key?</span>
                <span class="leading-8 text-center cursor-pointer cst-tr" style=" display:none;">
                Yes, creating an account helps track your purchase history and manage your keys.
                </span>
            </div>

            <div class="flex flex-col justify-center space-y-2">
                <span class="leading-8 font-audio text-center cursor-pointer cst-tr hover:text-primary hover:scale-105" onclick="toggleAnswer(this)">3. How long does it take to receive my game key after purchase?</span>
                <span class="leading-8 text-center cursor-pointer cst-tr" style=" display:none;">
                Most keys are delivered instantly via email, but some may take up to 24 hours.
                </span>
            </div>

            <div class="flex flex-col justify-center space-y-2">
                <span class="leading-8 font-audio text-center cursor-pointer cst-tr hover:text-primary hover:scale-105" onclick="toggleAnswer(this)">4. What payment methods do you accept?</span>
                <span class="leading-8 text-center cursor-pointer cst-tr" style=" display:none;">
                We accept major credit cards, PayPal, and other popular payment methods depending on your region.
                </span>
            </div>

            <div class="flex flex-col justify-center space-y-2">
                <span class="leading-8 font-audio text-center cursor-pointer cst-tr hover:text-primary hover:scale-105" onclick="toggleAnswer(this)">5. How can I contact your support team?</span>
                <span class="leading-8 text-center cursor-pointer cst-tr" style=" display:none;">
                    Visit the contact page on our website.
                </span>
            </div>
        </div>
    </div>
@endsection


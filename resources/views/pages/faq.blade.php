@extends('layouts.app')

@section('content')


<div class="flex">
        <span class="" style="margin-bottom:1em; font-size: 1.5em;">Frequently Asked Questions</span>
    </div>

    <div class="flex flex-col justify-center space-y-2">
        <span class="leading-8 text-center" onclick="toggleAnswer(this)" style="cursor:pointer;">1. What is a game key, and how does it work?</span>
        <span class="leading-8 text-center" style=" display:none; transition: all 2s ease-in-out;">
        A game key is a unique code used to activate and download a digital game on platforms like Steam or Epic Games.
        </span>
    </div>
    <div class="flex flex-col space-y-2">
        <span class="leading-8 text-center" onclick="toggleAnswer(this)" style="cursor:pointer;">2. Do I need an account to buy a game key?</span>
        <span class="leading-8 text-center" style=" display:none; transition: widht 2s linear 1s;">
        Yes, creating an account helps track your purchase history and manage your keys.
        </span>
    </div>
    <div class="flex flex-col justify-center space-y-2">
        <span class="leading-8 text-center" onclick="toggleAnswer(this)" style="cursor:pointer;">3. How long does it take to receive my game key after purchase?</span>
        <span class="leading-8 text-center" style=" display:none; transition: widht 2s linear 1s;">
        Most keys are delivered instantly via email, but some may take up to 24 hours.
        </span>
    </div>
    <div class="flex flex-col justify-center space-y-2">
        <span class="leading-8 text-center" onclick="toggleAnswer(this)" style="cursor:pointer;">4. What payment methods do you accept?</span>
        <span class="leading-8 text-center" style=" display:none; transition: widht 2s linear 1s;">
        We accept major credit cards, PayPal, and other popular payment methods depending on your region.
        </span>
    </div>
    <div class="flex flex-col justify-center space-y-2">
        <span class="leading-8 text-center" onclick="toggleAnswer(this)" style="cursor:pointer;">5. How can I contact your support team?</span>
        <span class="leading-8 text-center" style=" display:none; transition: widht 2s linear 1s;">
            Visit the contact page on our website.
        </span>
    </div>

 
</div>
<script type="text/javascript">
    function toggleAnswer(element) {
    const answer = element.nextElementSibling;
    answer.style.display = answer.style.display === "block" ? "none" : "block";
    element.classList.toggle("active");
}
</script>
@endsection


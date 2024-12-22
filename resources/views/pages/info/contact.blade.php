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
        <!-- Email Section -->
        <div class="flex flex-col justify-center space-y-4">
            <span class="leading-8 text-center font-audio text-3xl">Email</span>
            <a href="mailto:gamesnest@support.com" class="leading-8 text-center text-lg hover:text-primary cst-tr">
                gamesnest@support.com
            </a>
        </div>

        <!-- Phone Section -->
        <div class="flex flex-col justify-center space-y-4">
            <span class="leading-8 text-center font-audio text-3xl">Phone</span>
            <a href="tel:+11234567890" class="leading-8 text-center text-lg hover:text-primary cst-tr">
                +1 (123) 456-7890
            </a>
        </div>

        <!-- Schedule Section -->
        <div class="flex flex-col justify-center space-y-1">
            <span class="leading-8 text-center font-audio text-3xl mb-2">Schedule</span>
            <span class="leading-8 text-center text-base">
                Monday-Friday 8:00 - 18:00
            </span>
            <span class="leading-8 text-center text-base">
                Saturday 9:00 - 16:00
            </span>
            <span class="leading-8 text-center text-base">
                Sunday/Public Holidays : Closed
            </span>
        </div>
    </div>
@endsection

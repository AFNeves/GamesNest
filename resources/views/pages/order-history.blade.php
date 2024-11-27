@extends('layouts.app')

@section('header-context')
    @include('components.header-context')
@endsection

@section('content')
    @if ($orders->isEmpty())
        <h1>No orders found</h1>
    @else
        <section id="orders">
            <h1>
                Your Orders History
            </h1>
            <table>
                <td>Order id</td>
                <td>Price</td>
                <td>Status</td>
                <td>Delivery Date</td>
                <td>Transaction Info</td>
                @each('partials.order',$orders, 'order')
                <article class="order">
                </article>
            </table>
        </section>
    @endif
@endsection

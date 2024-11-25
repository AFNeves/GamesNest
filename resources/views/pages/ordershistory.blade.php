@extends('layouts.app')

@section('title', 'Orders')

@section('content')
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
@endsection

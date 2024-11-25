@extends('layouts.app')

@section('title', 'Keys')

@section('content')
    <section id="Keys">
        <h1>
            Your Key Iventory
        </h1>
        @foreach($orders as $order)
            <table>
                <td></td>
                <td>Order Id</td>
                <td>Game</td>
                <td>Price</td>
                <td>Delivery Date</td>
                <td>Platform</td>
                <td>Region</td>
                <td>Key</td>
                @each('partials.key',$order->keys, 'key')
                <article class="key">
                </article>
            </table>
        @endforeach
    </section>
@endsection
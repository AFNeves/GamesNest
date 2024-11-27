@extends('layouts.app')

@section('header-context')
    @include('components.header-context')
@endsection

@section('content')
    <section id="Order">
        <h1>
            Order: {{$order->id}}
        </h1>
        <l>Status: {{$order->status}}</l>
        <p></p>
        <l>Delivery Date: {{ \Carbon\Carbon::parse($order->deliver_date)->format('F j, Y') }}</l>
        <l></l>
            <table>
                <td></td>
                <td>Game</td>
                <td>Price</td>
                <td>Platform</td>
                <td>Region</td>
                <td>Key</td>
                @each('partials.key2',$order->keys, 'key')
                <article class="key">
                </article>
            </table>
    </section>
@endsection

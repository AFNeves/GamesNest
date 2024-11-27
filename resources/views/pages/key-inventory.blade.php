@extends('layouts.app')

@section('header-context')
    @include('components.header-context')
@endsection

@section('content')
    <section id="Keys">
        <h1>
            Your Key Inventory
        </h1>
        @foreach($keys as $key)
            <table>
                <td></td>
                <td>Order Id</td>
                <td>Game</td>
                <td>Price</td>
                <td>Delivery Date</td>
                <td>Platform</td>
                <td>Region</td>
                <td>Key</td>
                @each('partials.key',$key, 'key')
                <article class="key">
                </article>
            </table>
        @endforeach
    </section>
@endsection
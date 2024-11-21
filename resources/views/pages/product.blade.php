@extends('layouts.app')

@section('title',$product->title)

@section('content')
    <section id="games">
        @include('partials.game', ['game' => $product])
    </section>
@endsection
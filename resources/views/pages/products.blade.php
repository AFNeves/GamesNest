@extends('layouts.app')

@section('title', 'Games')

@section('content')
    <section id="games">
        <h1>
            {{ $product->title ?? 'Game name' }}
        </h1>
        <a>
            {{ $product->images ?? 'Images' }}
        </a>
        <article>
            {{ $product->description ?? 'Description' }}
        </article>
        <a>{{ $product->price ?? 'Price' }}</a>
        <a>{{ $product->rating ?? 'Rating' }}</a>
        <a>{{ $product->platform ?? 'Platform' }}</a>
        <a>{{ $product->region ?? 'Region' }}</a>
        <p>

        @if($product)
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
        @endif

        <a class="buttom">Add to cart old</a>
        <a class="buttom">Add to favourites</a>
    </section>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
@endsection
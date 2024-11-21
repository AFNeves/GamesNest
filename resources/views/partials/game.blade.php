<article class="product" data-id="<<{{ $product->id }}">
    <header>
        <h2><a href="/products/{{ $product->id }}">{{ $product->title }}</a> </h2>

    </header>
    <ul>
        {{$product->images}}
    </ul>
    <ul>
        {{$product->price}}
    </ul>
    <ul>
        {{$product->rating}}
    </ul>
</article>
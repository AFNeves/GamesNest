<style>
    .key table {
        width: 100%;
        border-collapse: collapse;
    }

    .key td {
        padding: 8px 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

</style>

<article class="key" data-id="{{ $key->id }}">
    <tr>
        <td><img src="{{ asset('/images/placeholder.png') }}" width='100' height='auto' alt="Default Image"></td>
        <td>{{ $key->product->title }}</td>
        <td>${{ number_format($key->product->price, 2) }}</td>
        <td>{{ $key->product->platform }}</td>
        <td>{{ $key->product->region }}</td>
        <td>{{ $key->key }}</td>
    </tr>
</article>
<style>
    .order table {
        width: 100%;
        border-collapse: collapse;
    }

    .order td {
        padding: 8px 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

</style>

<article class="order" data-id="{{ $order->id }}">
    <tr>
        <td><a href="{{route('orderdetails', ['id' => $order->id])  }}">View order: {{$order->id}}</a></td>
        <td>${{ number_format($order->price, 2) }}</td>
        <td>{{ $order->status }}</td>
        <td>{{ \Carbon\Carbon::parse($order->deliver_date)->format('F j, Y') }}</td>
        <td>{{$order->transaction->id}} - {{$order->transaction->provider}}</td>
    </tr>
</article>

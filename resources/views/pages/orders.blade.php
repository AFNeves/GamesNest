@extends('layouts.app')

@section('search-bar')
    @include('widgets.header.search-bar')
@endsection

@section('header-options')
    @include('widgets.header.header-options')
@endsection

@section('footer-logo')
    @include('widgets.footer.footer-logo')
@endsection

@section('footer-nav')
    @include('widgets.footer.footer-nav')
@endsection

@section('content')
    @if ($orders->isEmpty())
        <span class="text-2xl">No orders found</span>
    @else
        <span class="text-2xl mb-4">
            Your Order History
        </span>
        <div class="container mx-auto px-4">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col">Order id</th>
                                    <th scope="col">Delivery Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Transaction Info</th>
                                    <th scope="col">Price</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="{{route('order.details',['user_id' => Auth::user()->id, 'order_id' => $order->id])}}" class="text-sm text-gray-500">{{$order->id}}</a></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($order->deliver_date)->format('F j, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->status }}</td>
                                        @if($order->transaction()->exists())
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$order->transaction->provider}}</td>
                                        @else
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">No transaction
                                                info
                                            </td>
                                        @endif
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($order->price, 2) }}
                                            €
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

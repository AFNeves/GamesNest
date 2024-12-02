@extends('layouts.app')

@section('header-context')
    @include('components.header-context')
@endsection

@section('content')
    @if ($orders->isEmpty())
        <h1>No orders found</h1>
    @else
        <h1>
            Your Order History
        </h1>
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
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$order->id}}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($order->deliver_date)->format('F j, Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->status }}</td>
                                            @if($order->transaction()->exists())
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$order->transaction->provider}}</td>
                                            @else
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">No transaction info</td>
                                            @endif
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($order->price, 2) }} €</td>
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

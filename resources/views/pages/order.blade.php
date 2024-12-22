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
    <span class="text-2xl">
        Your Order Summary
    </span>
    <div>
        @if($order->status !=\App\Enums\Status::Completed )
            <form method="POST" action="{{ route('order.confirm', ['id' => $order->id]) }}" enctype="multipart/form-data" class="auth-form mb-4">
                @csrf
                <input type="hidden" name="id" value="{{ $order->id }}">
                <button type="submit" class="bg-green-500 rounded-lg p-4">See Keys!</button>
            </form>
            <form method="POST" action="{{route('order.delete',['id' => $order->id])}}" enctype="multipart/form-data" class="auth-form mb-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $order->id }}">
                <button type="submit" class="bg-red-800 rounded-lg p-4">Cancel Order</button>
            </form>
        @endif
    </div>
    <div class="container mx-auto px-4">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow-md sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Status</th>
                                <th scope="col">Price</th>
                                <th scope="col">Key</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($order->keys as $key)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$key->product->title}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$order->status}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$key->product->price}}</td>
                                    @if($order->status != \App\Enums\Status::Completed)
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">XXXXX-XXXXX-XXXXX-XXXXX-XXXXX</td>
                                    @else
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$key->key}}</td>
                                    @endif

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

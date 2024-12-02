@extends('layouts.app')

@section('header-context')
    @include('components.header-context')
@endsection

@section('content')
    @if ($keys->isEmpty())
        <h1>No keys found</h1>
    @else
        <h1>
            Your Key Inventory
        </h1>
        <div class="container mx-auto px-4">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th scope="col">Order Id</th>
                                        <th scope="col">Game</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Platform</th>
                                        <th scope="col">Region</th>
                                        <th scope="col">Key</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($keys as $key)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $key->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $key->title }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $key->price }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $key->platform }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $key->region }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $key->key }}</td>
                                        </tr>
                                    @endforeach

                                    {{--
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
                                                @each('partials.key', $key, 'key')
                                                <article class="key">
                                                </article>
                                            </table>
                                        @endforeach
                                     --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

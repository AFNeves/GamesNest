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
    @if ($keys->isEmpty())
        <span class="text-2xl">No keys found</span>
    @else
        <span class="text-2xl mb-4">
            Your Key Inventory
        </span>
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
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $key->platform }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $key->region }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $key->key }}</td>
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

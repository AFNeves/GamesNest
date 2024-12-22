@extends('layouts.app')

@section('header-options')
    @include('widgets.header.header-options')
@endsection

@section('content')
    @if ($products->isEmpty())
        <h1 class="text-2xl text-center">No users found</h1>
    @else
        <div class="flex flex-col flex-grow justify-start items-center w-full space-y-4 px-[30px]">
            <div class="overflow-hidden rounded-lg w-full">
                <table class="min-w-full divide-y divide-dark">
                    <thead class="bg-gray-100">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col" colspan="2">Actions</th>
                        <th scope="col">Visibility</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-dark">
                        @foreach($products as $product)
                            <tr id="row-{{$product->id}}" class="products-row">
                                {{-- Information --}}
                                <td class="flex items-center space-x-3 px-4 pt-1.5 pb-2">
                                    <div class="flex flex-col space-y-1">
                                        <span>{{ $product->title }}</span>

                                        <span>{{ $product->username }}</span>

                                        <span>{{ $product->email }}</span>
                                    </div>
                                </td>
                                {{-- Actions --}}
                                <td>
                                    <a href="{{ route('product.show', ['id' => $product->id]) }}" class="view-profile-button" >View Product</a>
                                </td>
                                <td>
                                    <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="edit-profile-button" >Edit Product</a>
                                </td>
                                <td>
                                    <button class="toggle-visibility-button" data-product-id="{{ $product->id }}">{{ $product->visibility ? 'Invisible' : 'Visible' }}</button>
                                </td>
                            </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            {{ $products->links() }}
        </div>
    @endif
@endsection

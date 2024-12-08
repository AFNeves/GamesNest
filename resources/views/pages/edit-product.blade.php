@extends('layouts.app')

@section('header-context')
    @include('components.header-context')
@endsection

@section('content')
    <h1>Editing Product Details</h1>
    <div class="flex flex-col flex-grow items-center justify-center py-4 w-full max-w-[calc(50%)]">
        <form method="POST" action="{{ route('product.update', ['id' => $product->id]) }}" class="auth-form w-2/3 p-4">
            @csrf

            <div class="space-y-6 whitespace-nowrap w-full">
                <input type="text" name="title" class="auth-form-input" placeholder="Title" value="{{ old('title', $product->title) }}" />

                <textarea name="description" class="auth-form-input" placeholder="Description" rows="6">{{old('description', $product->description) }}
                </textarea>

                <select id="platform" name="platform" class="auth-form-input">
                    <option value="{{$product->platform}}"> {{$product->platform}}</option>
                    @foreach($platforms as $platform)
                        @if($platform !== $product->platform)
                            <option value="{{$platform}}"> {{$platform}}</option>
                        @endif
                    @endforeach
                </select>

                <select id="region" name="region" class="auth-form-input">
                    <option value="{{$product->region}}"> {{$product->region}}</option>
                    @foreach($regions as $region)
                        @if($region !== $product->region)
                            <option value="{{$region}}"> {{$region}}</option>
                        @endif
                    @endforeach
                </select>

                <select id="type" name="type" class="auth-form-input    ">
                    <option value="{{$product->type}}"> {{$product->type}}</option>
                    @foreach($types as $type)
                        @if($type !== $product->type)
                            <option value="{{$type}}"> {{$type}}</option>
                        @endif
                    @endforeach
                </select>

                <input type="number" name="price" class="auth-form-input" placeholder="Price" min="0,99" max="100" step="0.01" value="{{ old('price', $product->price) }}" />
            </div>

            <button type="submit" class="auth-form-button mt-10">Save</button>

            @if ($errors->any())
                <div class="text-red-500 text-base mt-8">
                    {{ $errors->first() }}
                </div>
            @endif
        </form>
    </div>
@endsection
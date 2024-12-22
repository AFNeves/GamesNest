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
    <div class="flex w-full max-w-[1600px] px-4">
        <div class="bg-gray-700 rounded-xl p-2 w-1/4 h-fit space-y-2">
            <h3 class="text-xl font-bold text-white">
                <button id="catButton" class="inline-flex items-center">
                    Category
                    <img id="catArrowDown" src="{{ asset('/images/icons/arrow_drop_down.svg') }}" class="w-5 h-5 ml-1" alt="More Categories"/>
                    <img id="catArrowUp" src="{{ asset('/images/icons/arrow_collect_up.svg') }}" class="w-5 h-5 ml-1 hidden" alt="Less Categories"/>
                </button>
            </h3>
            <div id="categories" class="hidden">
                @foreach(\App\Http\Controllers\CategoryController::getCategories() as $category)
                    <ul class="text-sm p-2 space-y-1">
                        <li><input type="checkbox" class="accent-purple-500" id="{{$category->id}}" name="categories[]" value="{{$category->id}}"
                                   onchange="updateFilters()"  {{ request('categories') && in_array($category->id, request('categories')) ? 'checked' : '' }}>
                            {{$category->name}}</li>
                        <!-- idk why the colors do no change PeepoSadge -->
                    </ul>
                @endforeach
            </div>
            <hr>
            <h4 class="text-xl font-bold text-white">
                <button id="platfButton" class="inline-flex items-center">
                    Platforms
                    <img id="platfArrowDown" src="{{ asset('/images/icons/arrow_drop_down.svg') }}" class="w-5 h-5 ml-1" alt="More Platforms"/>
                    <img id="platfArrowUp" src="{{ asset('/images/icons/arrow_collect_up.svg') }}" class="w-5 h-5 ml-1 hidden" alt="Less Platforms"/>
                </button>
            </h4>
            <div id="platforms" class="hidden">
                @foreach(\App\Enums\Platform::cases() as $platform)
                    <ul class="text-sm p-2 space-y-1">
                        <li><input type="checkbox" class="accent-purple-500" id="{{$platform}}" name="platforms[]" value="{{$platform}}"
                                   onchange="updateFilters()"  {{ request('platforms') && in_array($platform->value, request('platforms')) ? 'checked' : '' }}>
                            {{$platform}}</li>
                    </ul>
                @endforeach
            </div>
            <hr>
            <h5 class="text-xl font-bold text-white">
                <button id="regionButton" class="inline-flex items-center">
                    Regions
                    <img id="regionArrowDown" src="{{ asset('/images/icons/arrow_drop_down.svg') }}" class="w-5 h-5 ml-1" alt="More Regions"/>
                    <img id="regionArrowUp" src="{{ asset('/images/icons/arrow_collect_up.svg') }}" class="w-5 h-5 ml-1 hidden" alt="Less Regions"/>
                </button>
            </h5>
            <div id="regions" class="hidden">
                @foreach(\App\Enums\Region::cases() as $region)
                    <ul class="text-sm p-2 space-y-1">
                        <li><input type="checkbox" class="accent-purple-500" id="{{$region}}" name="regions[]" value="{{$region}}"
                                   onchange="updateFilters()"  {{ request('regions') && in_array($region->value, request('regions')) ? 'checked' : '' }}>
                            {{$region}}</li>
                        <!-- idk why the colors do no change PeepoSadge -->
                    </ul>
                @endforeach
            </div>
            <hr>
            <h6 class="text-xl font-bold text-white">
                <button id="typeButton" class="inline-flex items-center">
                    Product Type
                    <img id="typeArrowDown" src="{{ asset('/images/icons/arrow_drop_down.svg') }}" class="w-5 h-5 ml-1" alt="More Types"/>
                    <img id="typeArrowUp" src="{{ asset('/images/icons/arrow_collect_up.svg') }}" class="w-5 h-5 ml-1 hidden" alt="Less Types"/>
                </button>
            </h6>
            <div id="types" class="hidden">
                @foreach(\App\Enums\ProductType::cases() as $type)
                    <ul class="text-sm p-2 space-y-1">
                    <li><input type="checkbox" class="accent-purple-500" id="{{$type}}" name="types[]" value="{{$type}}"
                               onchange="updateFilters()"  {{ request('types') && in_array($type->value, request('types')) ? 'checked' : '' }}>
                    {{$type}}</li>
                    <!-- idk why the colors do no change PeepoSadge -->
                    </ul>
                @endforeach
            </div>
            <hr>
            <h1 class="text-xl font-bold text-white">
                Price Ranges
            </h1>
                <div id="price ranges">
                    {{ request('types') && in_array($type->value, request('types')) ? 'checked' : '' }}
                    <input type="number" name="price_lower" class="auth-form-input" placeholder="Price Min" min="0" max="100"
                           step="0.01" onchange="validatePricesAndUpdate()" value="{{request('price_lower')}}" />
                    <input type="number" name="price_higher" class="auth-form-input" placeholder="Price Max" min="0" max="100"
                           step="0.01" onchange="validatePricesAndUpdate()" value="{{request('price_higher')}}"/>
                    <p id="price-error" style="color: red; display: none;">Higher price must be greater than or equal to the lower price.</p>
                </div>
        </div>
        @if ($products->isEmpty())
            <div class="flex flex-col flex-grow items-center justify-center p-4 w-full rounded-xl space-y-4">
                <h1 class="text-4xl">No products found</h1>
            </div>
        @else
            <div class="flex flex-col flex-grow items-center justify-center w-full pl-4">
                <div class="flex flex-col flex-grow items-center justify-start p-4 mb-4 w-full bg-gray-600 rounded-xl space-y-4">
                    @foreach($products as $product)
                        <a href="{{ route('product.show', ['id' => $product->id]) }}" class="flex w-full bg-gray-800 rounded-xl p-3 space-x-8">
                            <img src="{{ url('/images/products/' . $product->id . '/' . scandir('images/products/' . $product->id)[2]) }}" alt="{{ $product->title }}" class="w-full max-w-64 h-auto rounded-lg">
                            <div class="flex flex-col flex-grow justify-evenly">
                                <span class="text-base">{{ $product->title }}</span>
                                <span class="text-base text-primary">{{ $product->region }}</span>
                                <span class="text-lg">{{ $product->price }}€</span>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        //stuff for categories
        const catButton = document.getElementById('catButton');
        const categories = document.getElementById('categories');
        const catArrowDown = document.getElementById('catArrowDown');
        const catArrowUp = document.getElementById('catArrowUp');

        catButton.addEventListener('click', () =>{
            categories.classList.toggle('hidden');
            catArrowUp.classList.toggle('hidden');
            catArrowDown.classList.toggle('hidden');
        });

        //stuff for platforms
        const platfButton = document.getElementById('platfButton');
        const platforms = document.getElementById('platforms');
        const platfArrowDown = document.getElementById('platfArrowDown');
        const platfArrowUp = document.getElementById('platfArrowUp');

        platfButton.addEventListener('click', () =>{
            platforms.classList.toggle('hidden');
            platfArrowUp.classList.toggle('hidden');
            platfArrowDown.classList.toggle('hidden');
        });

        //stuff for regions
        const regionButton = document.getElementById('regionButton');
        const regions = document.getElementById('regions');
        const regionArrowDown = document.getElementById('regionArrowDown');
        const regionArrowUp = document.getElementById('regionArrowUp');

        regionButton.addEventListener('click', () =>{
            regions.classList.toggle('hidden');
            regionArrowUp.classList.toggle('hidden');
            regionArrowDown.classList.toggle('hidden');
        });

        //stuff for types
        const typeButton = document.getElementById('typeButton');
        const types = document.getElementById('types');
        const typeArrowDown = document.getElementById('typeArrowDown');
        const typeArrowUp = document.getElementById('typeArrowUp');

        typeButton.addEventListener('click', () =>{
            types.classList.toggle('hidden');
            typeArrowUp.classList.toggle('hidden');
            typeArrowDown.classList.toggle('hidden');
        });

    });

    function validatePricesAndUpdate() {
        const priceLowerInput = document.querySelector('input[name="price_lower"]');
        const priceHigherInput = document.querySelector('input[name="price_higher"]');
        const priceError = document.getElementById('price-error');

        const priceLower = parseFloat(priceLowerInput.value) || 0;
        const priceHigher = parseFloat(priceHigherInput.value) || 1000;

        if (priceHigher < priceLower) {
            priceError.style.display = 'block';
            return;
        }

        priceError.style.display = 'none';
        updateFilters();
    };

    //stuff to filter
    function updateFilters() {
        const selectedCategories = Array.from(document.querySelectorAll('input[name="categories[]"]:checked'))
            .map(checkbox => checkbox.value);

        const selectedPlatforms = Array.from(document.querySelectorAll('input[name="platforms[]"]:checked'))
            .map(checkbox => checkbox.value);

        const selectedRegions = Array.from(document.querySelectorAll('input[name="regions[]"]:checked'))
            .map(checkbox => checkbox.value);

        const selectedTypes = Array.from(document.querySelectorAll('input[name="types[]"]:checked'))
            .map(checkbox => checkbox.value);


        const priceLower = document.querySelector('input[name="price_lower"]').value;
        const priceHigher = document.querySelector('input[name="price_higher"]').value;
        const priceError = document.getElementById('price-error');

        const url = new URL(window.location.href);



        const keysToDelete = [];
        url.searchParams.forEach((value, key) => {
            if (key === 'categories[]' || key === 'platforms[]' || key === 'regions[]' || key === 'types[]'|| key === 'price_lower' || key === 'price_higher') {
                keysToDelete.push(key);
            }
        });

        keysToDelete.forEach(key => url.searchParams.delete(key));

        selectedCategories.forEach(category => url.searchParams.append('categories[]', category));
        selectedPlatforms.forEach(platform => url.searchParams.append('platforms[]', platform));
        selectedRegions.forEach(region => url.searchParams.append('regions[]', region));
        selectedTypes.forEach(type => url.searchParams.append('types[]', type));

        if (priceLower) {
            url.searchParams.append('price_lower', priceLower);
        }
        if (priceHigher) {
            url.searchParams.append('price_higher', priceHigher);
        }

        window.location.href = url.toString();
    }
</script>

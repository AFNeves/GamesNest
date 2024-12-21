<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Enums\Region;
use App\Enums\Platform;
use App\Enums\ProductType;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Validates the product request data.
     */
    private function validateProduct(Request $request): array
    {
        return $request->validate([
            'title' => 'required|unique:products,title|max:255|string',
            'description' => 'required|string',
            'images' => 'required|string',
            'type' => ['required', Rule::enum(ProductType::class)],
            'platform' => ['required', Rule::enum(Platform::class)],
            'region' => ['required', Rule::enum(Region::class)],
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/|min:0|max:100',
            'rating' => 'nullable|regex:/^\d+(\.\d{1,2})?$/|min:0|max:5',
            'visibility' => 'required|boolean',
            'discount_id' => 'nullable|exists:discounts,id'
        ]);
    }

    /**
     * Shows the first 10 products using pagination.
     */
    public function index(Request $request): View|Response
    {
        try {
            $selectedCats = $request->input('categories', []);
            $selectedPlatforms = $request->input('platforms', []);
            $selectedRegions = $request->input('regions', []);
            $selectedTypes = $request->input('types', []);
            $minPrice = $request->input('price_lower', 0);
            $maxPrice = $request->input('price_higher', 0);

            if(empty($selectedCats) and empty($selectedPlatforms) and empty($selectedRegions) and empty($selectedTypes) and $maxPrice===0 and $minPrice===0) {
                $products = Product::where('visibility', true)
                    ->orderBy('id', 'asc')
                    ->paginate(10);

                return view('pages.products', ['products' => $products]);
            }
            if($selectedRegions === []){
                $selectedRegions = Region::cases();
            }
            if($selectedPlatforms === []){
                $selectedPlatforms = Platform::cases();
            }
            if($selectedTypes === []){
                $selectedTypes = ProductType::cases();
            }
            if($maxPrice === 0){
                $maxPrice = 1000;
            }
            if($selectedCats === []){
                $products = Product::where('visibility', true)
                    ->whereIn('region', $selectedRegions)
                    ->whereIn('platform', $selectedPlatforms)
                    ->whereIn('type', $selectedTypes)
                    ->where('price', '>=', $minPrice)
                    ->where('price', '<=', $maxPrice)
                    ->orderBy('id', 'asc')
                    ->paginate(10);
                return view('pages.products', ['products' => $products]);
            }
            $products = Product::where('visibility', true)
                ->whereIn('region', $selectedRegions)
                ->whereIn('platform', $selectedPlatforms)
                ->whereIn('type', $selectedTypes)
                ->whereHas('categories', function ($query) use ($selectedCats) {
                    $query->whereIn('id', $selectedCats);
                })
                ->where('price', '>=', $minPrice)
                ->where('price', '<=', $maxPrice)
                ->orderBy('id', 'asc')
                ->paginate(10);
            return view('pages.products', ['products' => $products]);

        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        } catch (ModelNotFoundException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        }
    }

    /**
     * Shows the product page with the given id.
     */
    public function show(int $id): View|Response
    {
        try {
            $product = Product::findOrFail($id);

            $this->authorize('search', $product);

            return view('pages.product', ['product' => $product]);
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        } catch (ModelNotFoundException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        }
    }

    /**
     * Searches for exact matches and redirects otherwise.
     */
    public function search(Request $request): RedirectResponse|Response
    {
        try {
            $this->authorize('search', Product::class);

            $query = $request->validate([
                'query' => 'required|string'
            ]);
            $exactMatch = Product::where('visibility', true)
                ->whereRaw("LOWER(title) = ?", [strtolower($query['query'])])
                ->first();

            if ($exactMatch) {
                return redirect()->route('product', ['id' => $exactMatch->id]);
            }

            return redirect()->route('display_search', ['query' => $query['query']]);
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        } catch (ValidationException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        }
    }

    /**
     * Performs a full-text search.
     */
    public function ftsearch(string $query): Collection|Response
    {
        try {
            $this->authorize('ftsearch', Product::class);

            return Product::where('visibility', true)
                ->whereRaw("tsvectors @@ plainto_tsquery('english', ?)", [$query])
                ->orderByRaw("ts_rank(tsvectors, plainto_tsquery('english', ?)) DESC", [$query])
                ->take(10)
                ->get();
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        } catch (ModelNotFoundException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        }
    }

    /**
     * Displays the search results.
     */
    public function display(Request $request): View|Response
    {
        try {
            $this->authorize('display', Product::class);

            $query = $request->validate([
                'query' => 'required|string'
            ]);

            $products = $this->ftsearch($query['query']);

            return view('pages.products', ['products' => $products]);
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        } catch (ValidationException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        }
    }

    /**
     * Shows the create product widget.
     */
    public function create(): View|Response
    {
        try {
            $this->authorize('create', Product::class);

            return view('widgets.create-product');
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        }
    }

    /**
     * Shows the edit product widget.
     */
    public function edit(int $id): View|Response
    {
        try {
            $product = Product::findOrFail($id);

            $this->authorize('edit', $product);

            $platforms = Platform::cases();
            $regions = Region::cases();
            $types = ProductType::cases();

            return view('pages.edit-product', ['product' => $product, 'platforms' => $platforms, 'regions' => $regions, 'types' => $types]);
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        } catch (ModelNotFoundException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        }
    }

    /**
     * Inserts a new product.
     */
    public function store(Request $request): JsonResponse|Response
    {
        try {
            $product = new Product();

            $this->authorize('store', $product);

            $validated = $this->validateProduct($request);

            $product->fill($validated);

            $product->save();

            return response()->json($product);
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        } catch (ValidationException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        }
    }

    /**
     * Updates a product.
     */
    public function update(Request $request, $id): RedirectResponse|Response
    {
        try {
            $product = Product::findOrFail($id);

            $this->authorize('update', $product);

            $selectedCats = $request->input('categories', []);

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'platform' => 'required|string|max:255',
                'region' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'price' => 'required|numeric',
            ]);

            $product->fill($validated);

            $product->save();

            $product->categories()->sync($selectedCats);

            return redirect()->route('product', ['id' => $product->id]);
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        } catch (ModelNotFoundException | ValidationException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        }
    }
}

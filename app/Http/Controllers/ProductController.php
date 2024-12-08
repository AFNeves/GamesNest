<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
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
    public function index(): View|JsonResponse
    {
        try {
            $products = Product::where('visibility', true)
                ->orderBy('id', 'asc')
                ->paginate(10);

            return view('pages.products', ['products' => $products]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Product not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the product page with the given id.
     */
    public function show(int $id): View|JsonResponse
    {
        try {
            $product = Product::findOrFail($id);

            $this->authorize('search', $product);

            return view('pages.product', ['product' => $product]);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Searches for exact matches and redirects otherwise.
     */
    public function search(Request $request): RedirectResponse|JsonResponse
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
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Performs a full-text search.
     */
    public function ftsearch(string $query): Collection|JsonResponse
    {
        try {
            $this->authorize('ftsearch', Product::class);

            return Product::where('visibility', true)
                ->whereRaw("tsvectors @@ plainto_tsquery('english', ?)", [$query])
                ->orderByRaw("ts_rank(tsvectors, plainto_tsquery('english', ?)) DESC", [$query])
                ->take(10)
                ->get();
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Displays the search results.
     */
    public function display(Request $request): View|JsonResponse
    {
        try {
            $this->authorize('display', Product::class);

            $query = $request->validate([
                'query' => 'required|string'
            ]);

            $products = $this->ftsearch($query['query']);

            return view('pages.products', ['products' => $products]);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Shows the create product widget.
     */
    public function create(): View|JsonResponse
    {
        try {
            $this->authorize('create', Product::class);

            return view('widgets.create-product');
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the edit product widget.
     */
    public function edit(int $id): View|JsonResponse
    {
        try {
            $product = Product::findOrFail($id);

            $this->authorize('edit', $product);

            $platforms = Platform::cases();
            $regions = Region::cases();
            $types = ProductType::cases();

            return view('pages.edit-product', ['product' => $product, 'platforms' => $platforms, 'regions' => $regions, 'types' => $types]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Product not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Inserts a new product.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $product = new Product();

            $this->authorize('store', $product);

            $validated = $this->validateProduct($request);

            $product->fill($validated);

            $product->save();

            return response()->json($product);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Updates a product.
     */
    public function update(Request $request, $id): RedirectResponse|JsonResponse
    {
        try {
            $product = Product::findOrFail($id);

            $this->authorize('update', $product);

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

            return redirect()->route('product', ['id' => $product->id]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Product not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }
}

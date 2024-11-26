<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;  
use Illuminate\Http\Request;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
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
    public function index(): JsonResponse
    {
        try {
            $products = Product::where('visibility', true)->paginate(10);

            $this->authorize('index', $products);

            return response()->json($products);
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

            $this->authorize('show', $product);

            return view('pages.product', ['product' => $product]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Product not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
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

            return view('widgets.edit-product', ['product' => $product]);
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
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);

            $this->authorize('update', $product);

            $validated = $this->validateProduct($request);

            $product->fill($validated);

            $product->save();

            return response()->json($product);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Product not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductKey as Key;

class ShopCartController extends Controller
{
    /**
     * Shows the shopping cart page.
     */
    public function show(int $id): View|JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            $this->authorize('show', $user);

            $items = $user->shoppingCart()->withPivot('quantity')->get();

            return view('pages.shopping-cart', ['user' => $user, 'items' => $items]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Order not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Inserts a new product into the shopping cart.
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        try {
            $validated = $request->validate([
                'product_id' => 'required|exists:products,id'
            ]);

            $product = Product::findOrFail((int) $validated['product_id']);

            if(!$product->shoppingCarts()->where('user_id', Auth::id())->exists()) {
                $product->shoppingCarts()->attach(Auth::id(), ['quantity' => 1]);
            }

            return redirect()->route('cart.show', ['id' => Auth::id()]); /* TODO: TO IMPLEMENT AJAX */
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Updates the quantity of a product in the shopping cart.
     */
    public function update(Request $request): RedirectResponse|JsonResponse
    {
        try {
            $validated = $request->validate([
                'product_id' => 'required|integer',
                'quantity' => 'required|integer|min:1'
            ]);

            $product = Product::findOrFail((int) $validated['product_id']);

            $item = $product->shoppingCarts()->where('user_id', Auth::id())->firstOrFail();

            $this->authorize('update', $item);

            $stock = Key::where('product_id', $product->id)->where('order_id', '!=', NULL)->count();

            if($stock < $validated['quantity']) {
                return response()->json(['error' => 'Not enough stock'], 400);
            }

            $product->shoppingCarts()->updateExistingPivot(Auth::id(), ['quantity' => $validated['quantity']]);

            return redirect()->route('cart.show', ['id' => Auth::id()]); /* TODO: TO IMPLEMENT AJAX */
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Product not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Deletes an item from the shopping cart.
     */
    public function destroy(Request $request): RedirectResponse|JsonResponse
    {
        try {
            $validated = $request->validate([
                'product_id' => 'required|exists:products,id'
            ]);

            $product = Product::findOrFail((int) $validated['product_id']);

            $product->shoppingCarts()->detach(Auth::id());

            return redirect()->route('cart.show', ['id' => Auth::id()]); /* TODO: TO IMPLEMENT AJAX */
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Product doesn\'t exist'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}

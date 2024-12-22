<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
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
    public function show(): View|JsonResponse
    {
        try {
            $user = User::findOrFail(Auth::id());

            $this->authorize('show', $user);

            $items = $user->shoppingCart()->withPivot('quantity')->get();

            return view('pages.shopping-cart', ['user' => $user, 'items' => $items]);
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        } catch (ModelNotFoundException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        }
    }

    /**
     * Inserts a new product into the shopping cart.
     */
    public function store(Request $request): RedirectResponse|Response
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
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        } catch (ModelNotFoundException | ValidationException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        }
    }

    /**
     * Updates the quantity of a product in the shopping cart.
     */
    public function update(Request $request): JsonResponse|RedirectResponse|Response
    {
        try {
            $validated = $request->validate([
                'product_id' => 'required|integer',
                'quantity' => 'required|integer|min:1'
            ]);

            $product = Product::findOrFail((int) $validated['product_id']);

            $item = $product->shoppingCarts()->where('user_id', Auth::id())->firstOrFail();

            $this->authorize('update', $item);

            $stock = Key::where('product_id', $product->id)->where('order_id', NULL)->count();

            if($stock < $validated['quantity']) {
                $toast = (object) [
                    'id' => 'toast-' . uniqid(),
                    'class' => 'toast-error',
                    'icon' => 'images/icons/error.svg',
                    'title' => 'Error!',
                    'message' => 'Not enough stock available for this product.',
                ];

                $toastHtml = view('widgets.toast', ['toast' => $toast])->render();

                return response()->json(['toast' => $toastHtml]);
            }

            $product->shoppingCarts()->updateExistingPivot(Auth::id(), ['quantity' => $validated['quantity']]);

            return redirect()->route('cart.show', ['id' => Auth::id()]); /* TODO: TO IMPLEMENT AJAX */
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        } catch (ModelNotFoundException | ValidationException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        }
    }

    /**
     * Deletes an item from the shopping cart.
     */
    public function destroy(Request $request): RedirectResponse|Response
    {
        try {
            $validated = $request->validate([
                'product_id' => 'required|exists:products,id'
            ]);

            $product = Product::findOrFail((int) $validated['product_id']);

            $product->shoppingCarts()->detach(Auth::id());

            return redirect()->route('cart.show', ['id' => Auth::id()]); /* TODO: TO IMPLEMENT AJAX */
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        } catch (ModelNotFoundException | ValidationException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        }
    }
}

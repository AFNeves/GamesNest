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

class WishlistController extends Controller{

    public function show(int $id): View|JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            $this->authorize('show', $user);

            $items = $user->wishlist()->get();

            return view('pages.wishlist', ['user' => $user, 'items' => $items]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Order not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    public function store(Request $request): RedirectResponse|JsonResponse{
        try {
            $validated = $request->validate([
                'product_id' => 'required|exists:products,id'
            ]);

            $product = Product::findOrFail((int) $validated['product_id']);

            if(!$product->wishlists()->where('user_id', Auth::id())->exists()) {
                $product->wishlists()->attach(Auth::id());
            }

            return redirect()->route('wishlist.show', ['id' => Auth::id()]); /* TODO: TO IMPLEMENT AJAX */
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'],   400);
        }
    }

    public function destroy(Request $request): RedirectResponse|JsonResponse
    {
        try {
            $validated = $request->validate([
                'product_id' => 'required|exists:products,id'
            ]);

            $product = Product::findOrFail((int) $validated['product_id']);

            $product->wishlists()->detach(Auth::id());

            return redirect()->route('wishlist.show', ['id' => Auth::id()]); /* TODO: TO IMPLEMENT AJAX */
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Product doesn\'t exist'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}
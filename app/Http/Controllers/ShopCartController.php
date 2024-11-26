<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShopCartController extends Controller
{
    public function index()
    {
        $cartItems = DB::select(
        'SELECT 
            p.id AS product_id,
            p.title,
            p.price,
            p.images,
            sc.quantity,
            COALESCE(p.price * (1 - d.percentage), p.price) AS final_price,
            (SELECT COUNT(*) FROM product_keys pk 
             WHERE pk.product_id = p.id AND pk.order_id IS NULL) AS available_stock
        FROM shopping_cart sc
        JOIN products p ON sc.product_id = p.id
        LEFT JOIN discounts d ON p.discount_id = d.id
        WHERE sc.user_id = ?',
         [Auth::id()]
        );
        return view('pages.shoppingcart', ['cartItems' => collect($cartItems)]);
    }

    public function update(Request $request, $productId)
    {
        $action = $request->input('action');
        $cart = DB::table('shopping_cart')
            ->where('user_id', Auth::id())
            ->where('product_id', $productId);

        if ($action === 'increase') {
            $cart->increment('quantity');
        } else {
            $cart->decrement('quantity');
        }

        return redirect()->back();
    }

    public function remove($productId)
    {
        DB::table('shopping_cart')
            ->where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->delete();

        return redirect()->back();
    }
    public function addToCart(Request $request, $productId)
    {
        // If user is not logged in, store in session
        if (!Auth::check()) {
            $cart = session()->get('cart', []);
            
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity']++;
            } else {
                $cart[$productId] = [
                    'quantity' => 1
                ];
            }
            
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart!');
        }
    
        // If user is logged in, use database
        $existingItem = DB::table('shopping_cart')
            ->where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();
    
        if ($existingItem) {
            DB::table('shopping_cart')
                ->where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->increment('quantity');
        } else {
            DB::table('shopping_cart')->insert([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    
        return redirect()->back()->with('success', 'Product added to cart!');
    }
}
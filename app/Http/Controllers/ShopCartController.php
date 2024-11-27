<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShopCartController extends Controller
{
    /**
     * Display the shopping cart page
     * Retrieves cart items with product details, prices, and available stock
     */
    public function index()
    {
        // Complex SQL query to get cart items with all necessary information
        $cartItems = DB::select(
        'SELECT 
            p.id AS product_id,
            p.title,
            p.price,
            p.images,
            sc.quantity,
            -- Calculate final price considering any active discounts
            COALESCE(p.price * (1 - d.percentage), p.price) AS final_price,
            -- Subquery to count available (unassigned) keys for this product
            (SELECT COUNT(*) FROM product_keys pk 
             WHERE pk.product_id = p.id AND pk.order_id IS NULL) AS available_stock
        FROM shopping_cart sc
        JOIN products p ON sc.product_id = p.id
        LEFT JOIN discounts d ON p.discount_id = d.id
        WHERE sc.user_id = ?',
         [Auth::id()]
        );
        // Convert to collection for easier manipulation in the view
        return view('pages.shoppingcart', ['cartItems' => collect($cartItems)]);
    }

    /**
     * Update item quantity in cart
     * Handles both increasing and decreasing quantity
     */
    public function update(Request $request, $productId)
    {
        $action = $request->input('action');
        $cart = DB::table('shopping_cart')
            ->where('user_id', Auth::id())
            ->where('product_id', $productId);

        // Increment or decrement based on button clicked
        if ($action === 'increase') {
            $cart->increment('quantity');
        } else {
            $currentQuantity = $cart->value('quantity');
            // If quantity is 1, remove the item
            if ($currentQuantity <= 1) {
                $cart->delete();
            } else {
                $cart->decrement('quantity');
            }
        }
        return redirect()->back();
    }

    /**
     * Remove item from cart
     * Deletes the entire cart entry for this product
     */
    public function remove($productId)
    {
        DB::table('shopping_cart')
            ->where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->delete();

        return redirect()->back();
    }

    /**
     * Add item to cart
     * Checks stock availability before adding
     */
    public function addToCart(Request $request, $productId)
    {
        // Check available stock
        $availableStock = DB::select('
            SELECT COUNT(*) as count 
            FROM product_keys 
            WHERE product_id = ? AND order_id IS NULL', 
            [$productId]
        )[0]->count;

        // Get current cart quantity for this product
        $currentCartQuantity = 0;
        if (Auth::check()) {
            $currentCartQuantity = DB::table('shopping_cart')
                ->where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->value('quantity') ?? 0;
        }

        // Check if adding one more would exceed available stock
        if ($currentCartQuantity + 1 > $availableStock) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        // Guest user handling - store cart in session
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

        // Logged-in user handling - store in database
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
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page
     * Shows order summary and collects shipping/payment information
     */
    public function show()
    {
        // Get all items in user's cart with their details and prices
        $cartItems = DB::select('
            SELECT 
                p.id AS product_id,
                p.title,
                p.price,
                sc.quantity,
                COALESCE(p.price * (1 - d.percentage), p.price) AS final_price
            FROM shopping_cart sc
            JOIN products p ON sc.product_id = p.id
            LEFT JOIN discounts d ON p.discount_id = d.id
            WHERE sc.user_id = ?', 
            [Auth::id()]
        );

        // Calculate total order amount including quantities and discounts
        $total = collect($cartItems)->sum(function($item) {
            return $item->final_price * $item->quantity;
        });

        // Pass cart items and total to the checkout view
        return view('pages.checkout', compact('cartItems', 'total'));
    }

    /**
     * Process the checkout
     * Validates input, processes payment, creates order
     */
    public function process(Request $request)
    {
        // Validate user input for shipping information
        $validated = $request->validate([
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'payment_method' => 'required|in:credit_card,paypal'
        ]);

        // To Do:
        // 1. Process payment through payment gateway
        // 2. Create order record in database
        // 3. Assign product keys to order
        // 4. Send confirmation email
        // 5. Handle payment failures

        $userId = Auth::id();
        // Clear user's cart after successful order
        DB::table('shopping_cart')
            ->where('user_id', Auth::id())
            ->delete();

        // Redirect to profile with success message
        return redirect()->route('profile', ['id' => $userId])
        ->with('success', 'Order placed successfully!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function show()
    {
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

        $total = collect($cartItems)->sum(function($item) {
            return $item->final_price * $item->quantity;
        });

        return view('pages.checkout', compact('cartItems', 'total'));
    }

    public function process(Request $request)
    {
        // Validate checkout data
        $validated = $request->validate([
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'payment_method' => 'required|in:credit_card,paypal'
        ]);

        // Process payment and create order (to be implemented)
        
        // Clear cart after successful order
        DB::table('shopping_cart')
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->route('profile')->with('success', 'Order placed successfully!');
    }
}
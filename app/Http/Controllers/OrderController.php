<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Casts\Address;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\User;
use App\Models\Order;
use App\Models\Transaction;

class OrderController extends Controller
{
    /**
     * Validates a order request data.
     */
    private function validateOrder(Request $request): array
    {
        return $request->validate([
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/|min:0|max:100',
            'status' => ['required', Rule::enum(Status::class)],
            'order_date' => 'required|date',
            'deliver_date' => 'nullable|date|after:start_date',
            'billing_address' => ['required', new Address],
            'user_id' => 'required|exists:users,id'
        ]);
    }

    /**
     * Shows the details of an order.
     */
    public function show(int $user_id, int $order_id): View|JsonResponse
    {
        try {
            $order = Order::findOrFail($order_id);

            $this->authorize('show', $order);

            return view('pages.order', ['order' => $order]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Order not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Lists all orders.
     */
    public function listUserOrders(int $id): View|JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            /* Throws an error even if the policy returns True */
            //$this->authorize('listUserOrders', $user);

            $orders = Order::where('user_id', $id)
                ->orderBy('orders.id', 'asc')
                ->get();

            return view('pages.orders', ['orders' => $orders]);
        } catch (ModelNotFoundException) {
            return view('pages.order-history', ['orders' => []]);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the checkout page.
     */
    public function create(Request $request): View|JsonResponse
    {
        try {
            $validated = $request->validate([
                'id' => 'required|exists:users,id'
            ]);

            $user = User::findOrFail((int) $validated['id']);

            if ($user->id !== Auth::id()) {
                throw new AuthorizationException();
            }

            $items = Auth::user()->shoppingCart()->withPivot('quantity')->get();

            return view('pages.checkout', ['items' => $items]);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Inserts a new order.
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        try {
            /* Authorize and Validate Request */
            $this->authorize('store');
            $validated = $this->validateOrder($request);

            /* Create Order Model */
            $order = new Order();
            $order->fill($validated);
            $order->save();

            /* Assign Keys */
            $shopCart = Auth::user()->shoppingCart();

            for ($i = 0; $i < count($shopCart); $i++) {
                $product = $shopCart[$i]->product;

                $assignedKey = $product->keys()->where('order_id', null)->first();
                $assignedKey->order_id = $order->id;

                $shopCart[$i]->delete();
            }

            /* TODO: REMOVE THIS PART IN PRODUCTION */

            $transaction = new Transaction();

            $transaction->date = $validated['order_date'];
            $transaction->amount = $validated['price'];
            $transaction->provider = 'PayPal';
            $transaction->status = 'Completed';
            $transaction->order_id = $order->id;

            $transaction->save();

            return redirect()->route('order.details', ['success' => 'Order placed successfully.', 'id' => $order->id]);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }
}

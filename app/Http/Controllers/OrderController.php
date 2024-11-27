<?php

namespace App\Http\Controllers;

use App\Casts\Address;
use App\Enums\Status;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Order;

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
     * Fetches an order.
     */
    public function details(int $id): View|JsonResponse
    {
        try {
            $order = Order::findOrFail($id);

            $this->authorize('details', $order);

            return view('pages.order-details', ['order' => $order]);
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
            $orders = Order::all()->where('user_id', $id);

            $this->authorize('listUserOrders', $orders);

            return view('pages.orders-history', ['orders' => $orders]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'No orders found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the users last order.
     */
    public function lastOrder(int $id): Order|JsonResponse
    {
        try {
            $order = Order::where('user_id', $id)
                ->orderBy('created_at', 'desc')
                ->firstOrFail();

            $this->authorize('listUserOrders', $order);

            return $order;
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'No orders found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the create order widget.
     */
    public function create(): View|JsonResponse
    {
        try {
            $this->authorize('create', Order::class);

            return view('widgets.create-order');
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the edit order widget.
     */
    public function edit(int $id): View|JsonResponse
    {
        try {
            $order = Order::findOrFail($id);

            $this->authorize('edit', $order);

            return view('widgets.edit-order', ['Order' => $order]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Order not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Inserts a new order.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $order = new Order();

            $this->authorize('store', $order);

            $validated = $this->validateOrder($request);

            $order->fill($validated);

            $order->save();

            return response()->json($order);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Updates an order.
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $order = Order::findOrFail($id);

            $this->authorize('update', $order);

            $validated = $this->validateOrder($request);

            $order->fill($validated);

            $order->save();

            return response()->json($order);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Order not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }
}

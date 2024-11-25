<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Collection as Collection;

use App\Models\Discount;

class DiscountController extends Controller
{
    /**
     * Validates a discount request data.
     */
    private function validateDiscount(Request $request): array
    {
        return $request->validate([
            'name' => 'required|unique:discounts|max:255|string|alpha',
            'percentage' => 'required|regex:/^0(\.\d{1,2})?$/|gt:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'promotion_id' => 'nullable|exists:promotions,id'
        ]);
    }

    /**
     * Fetches a discount.
     */
    public function fetch(int $id): Discount|JsonResponse
    {
        try {
            $this->authorize('fetch', Discount::class);

            return Discount::findOrFail($id);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Discount not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Lists all discounts.
     */
    public function list(): Collection|JsonResponse
    {
        try {
            $this->authorize('list', Discount::class);

            return Discount::all();
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the create discount widget.
     */
    public function create(): View|JsonResponse
    {
        try {
            $this->authorize('create', Discount::class);

            return view('widgets.create-discount');
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the edit discount widget.
     */
    public function edit(int $id): View|JsonResponse
    {
        try {
            $discount = Discount::findOrFail($id);

            $this->authorize('edit', $discount);

            return view('widgets.edit-discount', ['Discount' => $discount]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Discount not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Inserts a new discount.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $discount = new Discount();

            $this->authorize('store', $discount);

            $validated = $this->validateDiscount($request);

            $discount->fill($validated);

            $discount->save();

            return response()->json($discount);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Updates a discount.
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $discount = Discount::findOrFail($id);

            $this->authorize('update', $discount);

            $validated = $this->validateDiscount($request);

            $discount->fill($validated);

            $discount->save();

            return response()->json($discount);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Discount not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Deletes a discount.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $discount = Discount::findOrFail($id);

            $this->authorize('destroy', $discount);

            $discount->delete();

            return response()->json($discount);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Discount not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}

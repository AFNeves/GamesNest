<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Collection as Collection;

use App\Models\Promotion;

class PromotionController extends Controller
{
    /**
     * Validates a promotion request data.
     */
    private function validatePromotion(Request $request): array
    {
        return $request->validate([
            'name' => 'required|unique:categories|max:255|string|alpha',
            'description' => 'required|string'
        ]);
    }

    /**
     * Show the promotion page for a given id.
     */
    public function show(int $id): View|JsonResponse
    {
        try {
            $promotion = Promotion::findOrFail($id);

            $this->authorize('show', $promotion);

            return view('pages.promotion', ['promotion' => $promotion]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Promotion not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Lists all categories.
     */
    public function list(): Collection|JsonResponse
    {
        try {
            $this->authorize('list', Promotion::class);

            return Promotion::all();
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the create promotion widget.
     */
    public function create(): View|JsonResponse
    {
        try {
            $this->authorize('create', Promotion::class);

            return view('widgets.create-promotion');
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the edit promotion widget.
     */
    public function edit(int $id): View|JsonResponse
    {
        try {
            $promotion = Promotion::findOrFail($id);

            $this->authorize('edit', $promotion);

            return view('widgets.edit-promotion', ['promotion' => $promotion]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Promotion not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Inserts a new promotion.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $promotion = new Promotion();

            $this->authorize('store', $promotion);

            $validated = $this->validatePromotion($request);

            $promotion->fill($validated);

            $promotion->save();

            return response()->json($promotion);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Updates a promotion.
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $promotion = Promotion::findOrFail($id);

            $this->authorize('update', $promotion);

            $validated = $this->validatePromotion($request);

            $promotion->fill($validated);

            $promotion->save();

            return response()->json($promotion);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Promotion not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Deletes a promotion.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $promotion = Promotion::findOrFail($id);

            $this->authorize('destroy', $promotion);

            $promotion->delete();

            return response()->json($promotion);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Promotion not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}

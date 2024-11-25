<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Rules\UniqueUserProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Validates the review request data.
     */
    private function validateReview(Request $request): array
    {
        return $request->validate([
            'text' => 'required|string',
            'rating' => 'required|regex:/^\d+(\.\d{1,2})?$/|min:0|max:5',
            'review_date' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'user_id' => ['required', 'exists:users,id', new UniqueUserProduct]
        ]);
    }

    /**
     * Shows the first 5 reviews using pagination.
     */
    public function index(int $product_id, int $user_id): JsonResponse
    {
        try {
            $reviews = Review::where('product_id', $product_id)
                             ->where('user_id', '!=', $user_id)
                             ->orderBy('review_date', 'desc')
                             ->paginate(5);

            $this->authorize('index', $reviews);

            return response()->json($reviews);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Review not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the review of a given user for a given product.
     */
    public function userReview(int $product_id, int $user_id): View|JsonResponse
    {
        try {
            $review = Review::where('product_id', $product_id)
                            ->where('user_id', $user_id)
                            ->firstOrFail();

            $this->authorize('userReview', $review);

            return view('partials.review', ['review' => $review]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Review not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the create review widget.
     */
    public function create(): View|JsonResponse
    {
        try {
            $this->authorize('create', Review::class);

            return view('widgets.create-review');
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the edit review widget.
     */
    public function edit(int $id): View|JsonResponse
    {
        try {
            $review = Review::findOrFail($id);

            $this->authorize('edit', $review);

            return view('widgets.edit-review', ['review' => $review]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Review not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Inserts a new review.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $review = new Review();

            $this->authorize('store', $review);

            $validated = $this->validateReview($request);

            $review->fill($validated);

            $review->save();

            return response()->json($review);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Updates a review.
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $review = Review::findOrFail($id);

            $this->authorize('update', $review);

            $validated = $this->validateReview($request);

            $review->fill($validated);

            $review->save();

            return response()->json($review);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Review not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Deletes a review.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $review = Review::findOrFail($id);

            $this->authorize('destroy', $review);

            $review->delete();

            return response()->json($review);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Review not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}

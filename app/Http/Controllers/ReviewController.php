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
    public function edit($id): View
    {
        try {
            $review = Review::findOrFail($id);

            if (auth()->id() !== $review->user_id) {
                abort(403, 'Unauthorized action.');
            }

            return view('widgets.edit-review', ['review' => $review]);
        } catch (ModelNotFoundException) {
            abort(404, 'Review not found.');
        }
    }

    /**
     * Inserts a new review.
     */
    public function store(Request $request)
    {
        try {
            $this->authorize('store', Review::class);
    
     
            $validated = $this->validateReview($request);
    
 
            $existingReview = Review::where('product_id', $validated['product_id'])
                                    ->where('user_id', $validated['user_id'])
                                    ->first();
    
            if ($existingReview) {
                return redirect()->back()->with('error', 'You have already reviewed this product.');
            }

            $review = new Review();
            $review->fill($validated);
            $review->save();
    
            return redirect()->route('product', ['id' => $validated['product_id']])
                             ->with('success', 'Review submitted successfully!');
        } catch (AuthorizationException) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        } catch (ValidationException $e) {
            return redirect()->back()
                             ->withErrors($e->errors())
                             ->withInput();
        }
    }
    
    

    /**
     * Updates a review.
     */
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);
    

        $request->validate([
            'text' => 'required|string|max:1000',
            'rating' => 'required|numeric|min:0|max:5',
        ]);
    

        $review->text = $request->input('text');
        $review->rating = $request->input('rating');
        $review->save();
    
        return redirect()->route('product', ['id' => $review->product_id])->with('success', 'Review updated successfully');
    }

    /**
     * Deletes a review.
     */
public function destroy($id)
{
    try {

        $review = Review::findOrFail($id);


        if (auth()->id() !== $review->user_id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }


        $productId = $review->product_id;


        $review->delete();


        return redirect()->route('product', $productId)->with('success', 'Review deleted successfully.');
    } catch (ModelNotFoundException $e) {

        return redirect()->back()->with('error', 'Review not found.');
    } catch (\Exception $e) {

        \Log::error('Error deleting review: ' . $e->getMessage());

        return redirect()->back()->with('error', 'Failed to delete review.');
    }
}

}
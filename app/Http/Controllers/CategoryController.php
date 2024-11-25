<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Collection as Collection;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Validates a category request data.
     */
    private function validateCategory(Request $request): array
    {
        return $request->validate([
            'name' => 'required|unique:categories|max:255|string|alpha',
            'description' => 'required|string'
        ]);
    }

    /**
     * Lists all categories.
     */
    public function list(): Collection|JsonResponse
    {
        try {
            $this->authorize('list', Category::class);

            return Category::all();
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the create category widget.
     */
    public function create(): View|JsonResponse
    {
        try {
            $this->authorize('create', Category::class);

            return view('widgets.create-category');
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Show the category page for a given id.
     */
    public function show(int $id): View|JsonResponse
    {
        try {
            $category = Category::findOrFail($id);

            $this->authorize('show', $category);

            return view('pages.category', ['category' => $category]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Category not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the edit category widget.
     */
    public function edit(int $id): View|JsonResponse
    {
        try {
            $category = Category::findOrFail($id);

            $this->authorize('edit', $category);

            return view('widgets.edit-category', ['category' => $category]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Category not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Inserts a new category.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $category = new Category();

            $this->authorize('store', $category);

            $validated = $this->validateCategory($request);

            $category->fill($validated);

            $category->save();

            return response()->json($category);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Updates a category.
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $category = Category::findOrFail($id);

            $this->authorize('update', $category);

            $validated = $this->validateCategory($request);

            $category->fill($validated);

            $category->save();

            return response()->json($category);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Category not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Deletes a category.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $category = Category::findOrFail($id);

            $this->authorize('destroy', $category);

            $category->delete();

            return response()->json($category);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Category not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}

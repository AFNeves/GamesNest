<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Collection as Collection;

use App\Models\ProductKey as Key;

class KeyController extends Controller
{
    /**
     * Validates a key request data.
     */
    private function validateKey(Request $request): array
    {
        return $request->validate([
            'key' => 'required|string|unique:product_keys,key|max:255',
            'order_id' => 'nullable|exists:promotions,id',
            'product_id' => 'required|exists:promotions,id',
        ]);
    }

    /**
     * Fetches a key.
     */
    public function fetch(int $id): Key|JsonResponse
    {
        try {
            $this->authorize('fetch', Key::class);

            return Key::findOrFail($id);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Key not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Lists all keys.
     */
    public function listUserKeys(User $user): Collection|JsonResponse
    {
        try {
            $keys = $user->productKeys();

            $this->authorize('list', $keys);

            return $keys;
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Keys not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the create key widget.
     */
    public function create(): View|JsonResponse
    {
        try {
            $this->authorize('create', Key::class);

            return view('widgets.create-key');
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the edit key widget.
     */
    public function edit(int $id): View|JsonResponse
    {
        try {
            $key = Key::findOrFail($id);

            $this->authorize('edit', $key);

            return view('widgets.edit-key', ['Key' => $key]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Key not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Inserts a new key.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $key = new Key();

            $this->authorize('store', $key);

            $validated = $this->validateKey($request);

            $key->fill($validated);

            $key->save();

            return response()->json($key);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Updates a key.
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $key = Key::findOrFail($id);

            $this->authorize('update', $key);

            $validated = $this->validateKey($request);

            $key->fill($validated);

            $key->save();

            return response()->json($key);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Key not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Deletes a key.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $key = Key::findOrFail($id);

            $this->authorize('destroy', $key);

            $key->delete();

            return response()->json($key);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Key not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Store a new user directly with the provided data.
     */
    public function storeDirect(array $data): User
    {
        return User::create($data);
    }

    /**
     * Shows the user management page.
     */
    public function manage(): View|JsonResponse
    {
        try {
            $this->authorize('manage', User::class);

            return view('pages.manage-users');
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the first 20 users using pagination.
     */
    public function index(): JsonResponse
    {
        try {
            $users = User::where('visibility', true)->paginate(20);

            $this->authorize('index', $users);

            return response()->json($users);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'User not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the user page with the given id.
     */
    public function show(int $id): View|JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            $this->authorize('show', $user);

            return view('pages.user', ['user' => $user]);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Shows the edit user widget.
     */
    public function edit(int $id): View|JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            $this->authorize('edit', $user);

            return view('widgets.edit-user', ['user' => $user]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'User not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Updates a user.
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            $this->authorize('update', $user);

            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'username' => 'required|string|min:5|max:20|unique:users,username',
                'email' => 'required|string|max:255|email|unique:users,email',
                'password' => 'required|string|max:255|confirmed',
            ]);

            $user->fill($validated);

            $user->save();

            return response()->json($user);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'User not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Deletes a user.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            $this->authorize('destroy', $user);

            $user->delete();

            return response()->json($user);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'User not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}

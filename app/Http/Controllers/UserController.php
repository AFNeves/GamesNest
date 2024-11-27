<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Shows the user management page.
     */
    public function manage(): View|JsonResponse
    {
        try {
            $this->authorize('manage', User::class);

            $users = User::orderBy('id', 'asc')->get();

            return view('pages.users', ['users' => $users]);
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
    public function show(int $id): View|RedirectResponse|JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            $this->authorize('show', $user);

            return view('pages.user', ['user' => $user]);
        } catch (AuthorizationException) {
            return redirect()->route('profile.show', ['id' => Auth::id()]);
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

            return view('pages.edit-user', ['user' => $user]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'User not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Updates a user.
     */
    public function update(Request $request, $id): RedirectResponse|JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            $this->authorize('update', $user);

            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
            ]);

            if ($request->has('username') && $request->username !== $user->username) {
                $validated['email'] = $request->validate([
                    'username' => 'required|string|min:5|max:20|unique:users,username',
                ])['username'];
            }

            if ($request->has('email') && $request->email !== $user->email) {
                $validated['email'] = $request->validate([
                    'email' => 'required|string|max:255|email|unique:users,email',
                ])['email'];
            }

            if ($request->has('password') && $request->password !== null) {
                $validated['password'] = $request->validate([
                    'password' => 'required|string|max:255|confirmed',
                ])['password'];
            }

            $user->fill($validated);

            $user->save();

            return redirect()->route('profile.show', ['id' => $user->id]);
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
    public function destroy(int $id): RedirectResponse|JsonResponse
    {
        try {
            $user = User::findOrFail($id);

            $this->authorize('destroy', $user);

            $user->delete();

            return redirect()->route('/');
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'User not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}

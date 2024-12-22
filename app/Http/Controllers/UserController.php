<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * Shows the admin dashboard page.
     */
    public function dashboard(): View|Response
    {
        try {
            $this->authorize('dashboard', Auth::user());

            return view('pages.admin.dashboard');
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        }
    }

    /**
     * Shows the user management page.
     */
    public function manage(): View|Response
    {
        try {
            $this->authorize('manage', Auth::user());

            $users = User::where('is_admin', false)
                ->where('id', '!=', 1)
                ->orderBy('id', 'asc')
                ->paginate(10);

            return view('pages.admin.user-panel', compact('users'));
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        }
    }

    /**
     * Shows the user page with the given id.
     */
    public function show(int $id): View|RedirectResponse|Response
    {
        try {
            $user = User::findOrFail($id);

            $this->authorize('show', $user);

            return view('pages.user.profile', ['user' => $user]);
        } catch (AuthorizationException) {
            return redirect()->route('profile.show', ['id' => Auth::id()]);
        } catch (ValidationException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        } catch (ModelNotFoundException) {
            return response()->view('pages.error', ['errorCode' => '404'], 404);
        }
    }

    /**
     * Shows the edit user widget.
     */
    public function edit(int $id): View|Response
    {
        try {
            $user = User::findOrFail($id);

            $this->authorize('edit', $user);

            return view('pages.edit-user', ['user' => $user]);
        } catch (ModelNotFoundException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        }
    }

    /**
     * Updates a user.
     */
    public function update(Request $request, $id): RedirectResponse|Response
    {
        try {
            $user = User::findOrFail($id);

            $this->authorize('update', $user);

            if ($request->has('first_name') && $request->first_name !== $user->first_name) {
                $validated['first_name'] = $request->validate([
                    'first_name' => 'required|string|max:255',
                ])['first_name'];
            }

            if ($request->has('last_name') && $request->last_name !== $user->last_name) {
                $validated['last_name'] = $request->validate([
                    'last_name' => 'required|string|max:255',
                ])['last_name'];
            }

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

            if($request->hasFile('profile_picture') && $request->profile_picture !== null) {
                $request->validate([
                    'profile_picture' => 'required|image|max:6144',
                ])['profile_picture'];

                $imageName = time() . '.' . $request->profile_picture->extension();

                $request->profile_picture->move(public_path('images/users/' . $user->id), $imageName);

                $validated['profile_picture'] = $imageName;
            }

            $user->fill($validated);

            $user->save();

            return redirect()->route('profile.show', ['id' => $user->id]);
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        } catch (ModelNotFoundException | ValidationException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        }
    }

    /**
     * Blocks or unblocks a user.
     */
    public function block(int $id): JsonResponse|Response
    {
        try {
            $user = User::findOrFail($id);

            $this->authorize('block', $user);

            $user->is_blocked = !$user->is_blocked;

            $user->save();

            $toast = (object) [
                'id' => 'toast-' . uniqid(),
                'class' => 'toast-success',
                'icon' => 'images/icons/check.svg',
                'title' => 'Success!',
                'message' => 'User has been ' . ($user->is_blocked ? 'blocked' : 'unblocked') . '.',
            ];

            $toastHtml = view('widgets.toast', ['toast' => $toast])->render();

            return response()->json(['success' => true, 'is_blocked' => $user->is_blocked , 'toast' => $toastHtml]);
        } catch (ModelNotFoundException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        }
    }

    /**
     * Deletes a user.
     */
    public function destroy(int $id): RedirectResponse|JsonResponse|Response
    {
        try {
            $user = User::findOrFail($id);

            $this->authorize('destroy', $user);

            $user->delete();

            if (Auth::id() == $id) {
                return redirect()->route('home');
            }

            $toast = (object) [
                'id' => 'toast-' . uniqid(),
                'class' => 'toast-success',
                'icon' => 'images/icons/check.svg',
                'title' => 'Success!',
                'message' => 'User has been deleted.',
            ];

            $toastHtml = view('widgets.toast', ['toast' => $toast])->render();

            return response()->json(['success' => true, 'deleted' => $id , 'toast' => $toastHtml]);
        } catch (ModelNotFoundException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        }
    }
}

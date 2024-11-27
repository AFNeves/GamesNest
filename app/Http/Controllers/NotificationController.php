<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Collection as Collection;

use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Validates a notification request data.
     */
    private function validateNotification(Request $request): array
    {
        return $request->validate([
            'title' => 'required|unique:categories|max:255|string|alpha',
            'message' => 'required|string'
        ]);
    }

    /**
     * Lists all notifications.
     */
    public function list(): Collection|JsonResponse
    {
        try {
            $this->authorize('list', Notification::class);

            return Notification::all();
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the create notification widget.
     */
    public function create(): View|JsonResponse
    {
        try {
            $this->authorize('create', Notification::class);

            return view('widgets.create-notification');
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Show the notification page for a given id.
     */
    public function show(int $id): View|JsonResponse
    {
        try {
            $notification = Notification::findOrFail($id);

            $this->authorize('show', $notification);

            return view('pages.notification', ['notification' => $notification]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Notification not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the edit notification widget.
     */
    public function edit(int $id): View|JsonResponse
    {
        try {
            $notification = Notification::findOrFail($id);

            $this->authorize('edit', $notification);

            return view('widgets.edit-notification', ['notification' => $notification]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Notification not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Inserts a new notification.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $notification = new Notification();

            $this->authorize('store', $notification);

            $validated = $this->validateNotification($request);

            $notification->fill($validated);

            $notification->save();

            return response()->json($notification);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Updates a notification.
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $notification = Notification::findOrFail($id);

            $this->authorize('update', $notification);

            $validated = $this->validateNotification($request);

            $notification->fill($validated);

            $notification->save();

            return response()->json($notification);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Notification not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Deletes a notification.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $notification = Notification::findOrFail($id);

            $this->authorize('destroy', $notification);

            $notification->delete();

            return response()->json($notification);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Notification not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}

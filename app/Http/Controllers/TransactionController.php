<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\Status;
use App\Enums\Provider;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Validates a transaction request data.
     */
    private function validateTransaction(Request $request): array
    {
        return $request->validate([
            'date' => 'required|date',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/|min:0|max:100',
            'provider' => ['required', Rule::enum(Provider::class)],
            'status' => ['required', Rule::enum(Status::class)],
            'order_id' => 'required|exists:orders,id'
        ]);
    }

    /**
     * Fetches a transaction.
     */
    public function fetch(int $id): View|JsonResponse
    {
        try {
            $transaction = Transaction::findOrFail($id);

            $this->authorize('fetch', $transaction);

            return view('pages.transaction-details', ['transaction' => $transaction]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Transaction not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Lists all transactions belonging to a user.
     */
    public function listUserTransactions(User $user): View|JsonResponse
    {
        try {
            $transactions = $user->transactions();

            $this->authorize('listUserTransactions', $transactions);

            return view('pages.transaction-history', ['transactions' => $transactions]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'No transactions found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the create transaction widget.
     */
    public function create(): View|JsonResponse
    {
        try {
            $this->authorize('create', Transaction::class);

            return view('widgets.create-transaction');
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Shows the edit transaction widget.
     */
    public function edit(int $id): View|JsonResponse
    {
        try {
            $transaction = Transaction::findOrFail($id);

            $this->authorize('edit', $transaction);

            return view('widgets.edit-transaction', ['Transaction' => $transaction]);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Transaction not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    /**
     * Inserts a new transaction.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $transaction = new Transaction();

            $this->authorize('store', $transaction);

            $validated = $this->validateTransaction($request);

            $transaction->fill($validated);

            $transaction->save();

            return response()->json($transaction);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }

    /**
     * Updates an transaction.
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $transaction = Transaction::findOrFail($id);

            $this->authorize('update', $transaction);

            $validated = $this->validateTransaction($request);

            $transaction->fill($validated);

            $transaction->save();

            return response()->json($transaction);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Transaction not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        } catch (ValidationException) {
            return response()->json(['error' => 'Validation failed'], 400);
        }
    }
    
    /**
     * Deletes a transaction.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $transaction = Transaction::findOrFail($id);

            $this->authorize('destroy', $transaction);

            $transaction->delete();

            return response()->json($transaction);
        } catch (ModelNotFoundException) {
            return response()->json(['error' => 'Transaction not found'], 404);
        } catch (AuthorizationException) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}

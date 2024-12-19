<?php

namespace App\Http\Controllers;

use App\Enums\Provider;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\PaymentMethod;

class PaymentController extends Controller
{
    /**
     * Validates a payment method request data.
     */
    private function validatePaymentMethod(Request $request): array
    {
        return $request->validate([
            'provider' => ['required', Rule::enum(Provider::class)],
            'details' => 'required|string',
            'user_id' => 'required|exists:users,id'
        ]);
    }

    /**
     * Fetches a payment method.
     */
    public function fetch(int $id): PaymentMethod|Response
    {
        try {
            $payment = PaymentMethod::findOrFail($id);

            $this->authorize('fetch', $payment);

            return $payment;
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        } catch (ModelNotFoundException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        }
    }

    /**
     * Lists all payment methods for a given user.
     */
    public function listUserPaymentMethods(int $id): View|Response
    {
        try {
            $payments = PaymentMethod::all()->where('user_id', $id);

            $this->authorize('listUserPaymentMethods', $payments);

            return view('pages.payment-methods', ['payment-methods' => $payments]);
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        } catch (ModelNotFoundException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        }
    }

    /**
     * Shows the create payment method widget.
     */
    public function create(): View|Response
    {
        try {
            $this->authorize('create', PaymentMethod::class);

            return view('widgets.create-payment-method');
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        }
    }

    /**
     * Shows the edit payment method widget.
     */
    public function edit(int $id): View|Response
    {
        try {
            $payment = PaymentMethod::findOrFail($id);

            $this->authorize('edit', $payment);

            return view('widgets.edit-payment-method', ['payment-method' => $payment]);
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        } catch (ModelNotFoundException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        }
    }

    /**
     * Inserts a new payment method.
     */
    public function store(Request $request): JsonResponse|Response
    {
        try {
            $payment = new PaymentMethod();

            $this->authorize('store', $payment);

            $validated = $this->validatePaymentMethod($request);

            $payment->fill($validated);

            $payment->save();

            return response()->json($payment);
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        } catch (ValidationException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        }
    }

    /**
     * Updates a payment method.
     */
    public function update(Request $request, $id): JsonResponse|Response
    {
        try {
            $payment = PaymentMethod::findOrFail($id);

            $this->authorize('update', $payment);

            $validated = $this->validatePaymentMethod($request);

            $payment->fill($validated);

            $payment->save();

            return response()->json($payment);
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        } catch (ModelNotFoundException | ValidationException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        }
    }

    /**
     * Deletes a payment method.
     */
    public function destroy(int $id): JsonResponse|Response
    {
        try {
            $payment = PaymentMethod::findOrFail($id);

            $this->authorize('destroy', $payment);

            $payment->delete();

            return response()->json($payment);
        } catch (AuthorizationException) {
            return response()->view('pages.error', ['errorCode' => '403'], 403);
        } catch (ModelNotFoundException) {
            return response()->view('pages.error', ['errorCode' => '400'], 400);
        }
    }
}

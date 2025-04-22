<?php

namespace App\Http\Controllers\Api;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;
use App\Models\User;


class PaymentController extends Controller
{
    /**
     * Retrieve a list of Payments.
     */
    public function index(Loan $loan)
    {
        $payments = Payment::where('loan_id', $loan->id)
            ->get();
        return [
            'payments' => $payments
        ];
    }

    /**
     * Create a new Customer.
     */
    public function store(Request $request, Loan $loan)
    {
        $user = $request->user();
        $request->merge([
            'loan_id' => $loan->id,
            'customer_id' => $loan->customer->id,
        ]);
        Log::info($request->all());
        $payment = Payment::create(
            $request->only([
                'customer_id',
                'loan_id',
                'payment_date',
                'payment_method',
                'payment_capital',
                'payment_interest',
                'payment_delay',
                'notes',
            ])
        );
        $payment->load('loan', 'customer');
        return response()
            ->json([
                'payment' => $payment
            ], 201);
    }

    /**
     * Retrieve the specified Payment.
     */
    public function show(Request $request, Payment $payment)
    {
        $user = $request->user();
        if( $payment->customer()->user_id !== $user->id ) {
            return response()
                ->json([
                    'code' => 'Forbidden',
                    'message' => 'Unauthorized access to this resource.'
                ], 403);
        }
        return response()
            ->json([
                'payment' => $payment
            ]);
    }

    /**
     * Update the specified Customer.
     */
    public function update(Request $request, User $user, Customer $customer)
    {
        if( $customer->user_id !== $user->id ) {
            return response()
                ->json([
                    'code' => 'Forbidden',
                    'message' => 'Unauthorized access to this resource.'
                ], 403);
        }
        $customer->fill(
            $request->only([
                'full_name',
                'document_id',
                'telephone',
                'email',
                'address',
                'notes',
                'user_id',
            ])
        );
        $customer->save();
        return response()
            ->json([
                'customer' => $customer
            ]);
    }

    /**
     * Delete the specified Customer.
     */
    public function destroy(User $user, Customer $customer)
    {
        if( $customer->user_id !== $user->id ) {
            return response()
                ->json([
                    'code' => 'Forbidden',
                    'message' => 'Unauthorized access to this resource.'
                ], 403);
        }
        $result = $customer->delete();
        return response()
            ->json([
                'result' => $result
            ]);
    }
}

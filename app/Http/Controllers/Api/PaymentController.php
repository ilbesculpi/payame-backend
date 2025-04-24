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

    public function getLoanPaymentHistory(Loan $loan, Request $request)
    {
        $user = $request->user();
        $payments = Payment::where('loan_id', $loan->id)
            ->get();
        return [
            'payments' => $payments
        ];
    }

    /**
     * Retrieve the specified Payment.
     */
    public function show(Request $request, Payment $payment)
    {
        $user = $request->user();
        if( $payment->customer->user_id !== $user->id ) {
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
     * Update the specified Payment.
     */
    public function update(Request $request, Payment $payment)
    {
        $user = $request->user();
        if( $payment->customer->user_id !== $user->id ) {
            return response()
                ->json([
                    'code' => 'Forbidden',
                    'message' => 'Unauthorized access to this resource.'
                ], 403);
        }
        $payment->fill(
            $request->only([
                'payment_date',
                'payment_method',
                'payment_capital',
                'payment_interest',
                'payment_delay',
                'notes',
            ])
        );
        $payment->save();
        return response()
            ->json([
                'payment' => $payment
            ]);
    }

    /**
     * Delete the specified Payment.
     */
    public function destroy(Request $request, Payment $payment)
    {
        $user = $request->user();
        if( $payment->customer->user_id !== $user->id ) {
            return response()
                ->json([
                    'code' => 'Forbidden',
                    'message' => 'Unauthorized access to this resource.'
                ], 403);
        }
        $result = $payment->delete();
        return response()
            ->json([
                'result' => $result
            ]);
    }

}

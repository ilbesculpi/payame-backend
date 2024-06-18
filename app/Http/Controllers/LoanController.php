<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Loan;
use App\Models\User;

class LoanController extends Controller
{
    /**
     * Retrieve a list of Loan.
     */
    public function index(User $user)
    {
        $loans = Loan::where('user_id', $user->id)
            ->with('customer')
            ->get();
        return [
            'loans' => $loans
        ];
    }

    /**
     * Create a new Loan.
     */
    public function store(Request $request, User $user)
    {
        $loan = Loan::makeInstance(
            $request->input('capital'),
            $request->input('interest_rate'),
            $request->input('payments'),
            $request->input('start_date'),
            $request->input('frequency'),
            $request->input('pay_day')
        );
        $loan->customer_id = $request->input('customer_id');
        $loan->user_id = $user->id;
        $loan->status = 'active';
        $loan->save();
        return response()
            ->json([
                'loan' => $loan
            ], 201);
    }

    /**
     * Retrieve the specified Loan.
     */
    public function show(User $user, Loan $loan)
    {
        if( $loan->user_id !== $user->id ) {
            return response()
                ->json([
                    'code' => 'Forbidden',
                    'message' => 'Unauthorized access to this resource.'
                ], 403);
        }
        // fetch associated Customer
        $loan->customer;
        return response()
            ->json([
                'loan' => $loan
            ]);
    }

    /**
     * Update the specified Loan.
     */
    public function update(Request $request, User $user, Loan $loan)
    {
        if( $loan->user_id !== $user->id ) {
            return response()
                ->json([
                    'code' => 'Forbidden',
                    'message' => 'Unauthorized access to this resource.'
                ], 403);
        }
        $loan->fill(
            $request->only([
                'start_date',
                'end_date',
                'interest_rate',
                'method',
                'capital',
                'quota',
                'frequency',
                'pay_day',
                'payments',
            ])
        );
        $loan->setInitalValues();
        $loan->save();
        return response()
            ->json([
                'loan' => $loan
            ]);
    }

    /**
     * Delete the specified Loan.
     */
    public function destroy(User $user, Loan $loan)
    {
        if( $loan->user_id !== $user->id ) {
            return response()
                ->json([
                    'code' => 'Forbidden',
                    'message' => 'Unauthorized access to this resource.'
                ], 403);
        }
        $result = $loan->delete();
        return response()
            ->json([
                'result' => $result
            ]);
    }

}

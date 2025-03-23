<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Loan;
use App\Models\User;

class LoanController extends Controller
{
    /**
     * Retrieve a list of Loan.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $loans = Loan::where('user_id', $user->id)
            ->with('customer', 'associate')
            ->get();
        return ['loans' => $loans];
    }

    /**
     * Create a new Loan.
     */
    public function store(Request $request, Customer $customer)
    {
        $user = $request->user();
        $loan = Loan::makeInstance(
            $request->input('capital'),
            $request->input('interest_rate'),
            $request->input('terms'),
            $request->input('start_date'),
            $request->input('frequency'),
            $request->input('pay_day'),
        );
        $loan->customer_id = $customer->id;
        $loan->user_id = $user->id;
        $loan->status = $request->input('status', 'active');
        $loan->save();

        if( $request->has('associates') ) {
            $associates = [];
            foreach ($request->input('associates') as $associate) {
                $associates[$associate['associate_id']] = ['percentage' => $associate['percentage']];
            }
            $loan->associate()->attach($associates);
        }

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
    public function update(Request $request, Loan $loan)
    {
        $user = $request->user();
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

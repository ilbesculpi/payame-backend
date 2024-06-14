<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;

class CustomerController extends Controller
{
    /**
     * Retrieve a list of Customer.
     */
    public function index(User $user)
    {
        $customers = Customer::where('user_id', $user->id)
            ->get();
        return [
            'customers' => $customers
        ];
    }

    /**
     * Create a new Customer.
     */
    public function store(Request $request, User $user)
    {
        $request->merge([
            'user_id' => $user->id
        ]);
        $customer = Customer::create(
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
        return response()
            ->json([
                'customer' => $customer
            ], 201);
    }

    /**
     * Retrieve the specified Customer.
     */
    public function show(User $user, Customer $customer)
    {
        if( $customer->user_id !== $user->id ) {
            return response()
                ->json([
                    'code' => 'Forbidden',
                    'message' => 'Unauthorized access to this resource.'
                ], 403);
        }
        return response()
            ->json([
                'customer' => $customer
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

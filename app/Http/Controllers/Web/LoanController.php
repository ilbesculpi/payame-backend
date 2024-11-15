<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Customer;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = 5;
        $loans = Loan::getUserActiveLoans($user_id)
            ->get();

        return view('loans.index')
            ->with('title', 'Loans')
            ->with('loans', $loans);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_id = 5;
        $customers = Customer::getUserCustomers($user_id)
            ->get();
        return view('loans.create')
            ->with('customers', $customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        //
    }
}

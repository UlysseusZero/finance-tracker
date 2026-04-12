<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\ExpensePayment;

class ExpensePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $expense = Expense::findOrFail($request->expense_id);

        if ($expense->user_id !== auth()->id()) {
            abort(403);
        }

        $expense->payments()->create([
            'month' => now()->month,
            'year' => now()->year,
        ]);

        return redirect()->back()->with('success', 'Expense marked as paid!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpensePayment $payment)
    {
        if ($payment->expense->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $payment->delete();

        return redirect()->back()->with('success', 'Expense payment deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = auth()->user()->expenses()->latest()->get();
        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validated = $request->validate ([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'category' => 'required|in:Loans,Electronics,Utilities,Transportation,Food,Allowance,Subscriptions,Others',
            'due_day' => 'nullable|integer|min:1|max:31',
            'is_recurring' => 'nullable|boolean',
            'recurring_end_date' => 'nullable|date|after:today',
        ]);

        $validated['is_recurring'] = $request->input('is_recurring', 0) == '1';

        auth()->user()->expenses()->create($validated);

        return redirect()->route('expenses.index')->with('success', 'Expense added successfully!');
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
    public function edit(Expense $expense)
    {
        if ($expense->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        if ($expense->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'category' => 'required|in:Loans,Electronics,Utilities,Transportation,Food,Allowance,Subscriptions,Others',
            'due_day' => 'nullable|integer|min:1|max:31',
            'is_recurring' => 'nullable|boolean',
            'recurring_end_date' => 'nullable|date|after:today',
        ]);

        $validated['is_recurring'] = $request->input('is_recurring', 0) == '1';

        if (!$validated['is_recurring']) {
            $validated['recurring_end_date'] = null;
        }

        $expense->update($validated);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        if ($expense->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully!');


    }
}

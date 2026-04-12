<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;

class SalaryController extends Controller
{
    public function index()
    {
        $currentSalary = auth()->user()->currentSalary;
        return view('salary.index', compact('currentSalary'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        auth()->user()->salaries()->create($validated);

        return redirect()->route('salary.index')->with('success', 'Salary Saved!');
    }
}

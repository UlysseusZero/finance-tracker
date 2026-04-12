<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $now = now();

        $currentSalary =  $user->currentSalary?->amount ?? 0;

        $expenses = $user->expenses()->with('payments')->get();

        $totalExpenses = $expenses->sum('amount');

        $totalPaid = $expenses->filter(function ($expense) use ($now) {
            return $expense->payments
                ->where('month', $now->month)
                ->where('year', $now->year)
                ->isNotEmpty();
        })->sum('amount');

        $remainingBalance = $currentSalary - $totalExpenses;

        return view ('dashboard', compact('currentSalary', 'totalExpenses', 'totalPaid', 'remainingBalance', 'expenses'));
    }
}

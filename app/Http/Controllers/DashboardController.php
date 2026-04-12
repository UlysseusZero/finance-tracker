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

        $expenses = $user->expenses()->with('payments')->where(function($query) use ($now) {
        $query->where(function($q) use ($now) {
            // Recurring expenses that haven't ended yet
            $q->where('is_recurring', true)
            ->where(function($q2) use ($now) {
                $q2->whereNull('recurring_end_date')
                    ->orWhere('recurring_end_date', '>=', $now->copy()->startOfMonth());
            });
        })->orWhere(function($q) use ($now) {
            // Non-recurring expenses created this month
            $q->where('is_recurring', false)
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year);
        });
    })->get();

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

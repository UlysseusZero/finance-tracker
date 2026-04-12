@extends('layouts.app')

@section('title', 'Dashboard - Finance Tracker')

@section('content')

    <div class="max-w-6xl mx-auto mt-10 p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Financial Overview - {{ now()->format('F Y') }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Current Salary</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">₱{{ number_format($currentSalary, 2) }}</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-orange-500">
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Expenses</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">₱{{ number_format($totalExpenses, 2) }}</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-green-500">
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Paid</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">₱{{ number_format($totalPaid, 2) }}</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 {{ $remainingBalance < 0 ? 'bg-red-50 border-l-4 border-l-red-500' : 'bg-blue-50 border-l-4 border-l-blue-500' }}">
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Remaining (Net)</p>
                <p class="text-2xl font-bold {{ $remainingBalance < 0 ? 'text-red-700' : 'text-blue-700' }} mt-1">
                    ₱{{ number_format($remainingBalance, 2) }}
                </p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Monthly Expense Summary</h3>
                <span class="text-xs font-semibold px-2 py-1 bg-gray-100 text-gray-600 rounded">Current Month</span>
            </div>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="p-4 text-sm font-semibold text-gray-600">Expense Name</th>
                        <th class="p-4 text-sm font-semibold text-gray-600">Category</th>
                        <th class="p-4 text-sm font-semibold text-gray-600">Amount</th>
                        <th class="p-4 text-sm font-semibold text-gray-600">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($expenses as $expense)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4 text-gray-800 font-medium">{{ $expense->name }}</td>
                            <td class="p-4"><span class="text-xs px-2 py-1 bg-blue-50 text-blue-600 rounded-full">{{ $expense->category }}</span></td>
                            <td class="p-4 text-gray-800">₱{{ number_format($expense->amount, 2) }}</td>
                            <td class="p-4">
                                @php
                                    $isPaid = $expense->payments
                                                ->where('month', now()->month)
                                                ->where('year', now()->year)
                                                ->isNotEmpty();
                                @endphp
                                @if($isPaid)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <span class="w-2 h-2 mr-1.5 bg-green-500 rounded-full"></span>
                                        Paid
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <span class="w-2 h-2 mr-1.5 bg-red-500 rounded-full"></span>
                                        Unpaid
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-gray-500">No expenses found. <a href="{{ route('expenses.create') }}" class="text-blue-500 underline">Add one now</a>.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
@endsection
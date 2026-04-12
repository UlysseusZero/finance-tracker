@extends('layouts.app')

@section('title', 'Expenses - Finance Tracker')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">My Expenses</h1>
        <a href="{{ route('expenses.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Add Expense
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-50 border-b">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Due Day</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Recurring</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($expenses as $expense)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $expense->name }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $expense->category }}
                            </span>
                        </td>
                        <td class="px-6 py-4">₱{{ number_format($expense->amount, 2) }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $expense->due_day ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm">
                            {{ $expense->is_recurring ? 'Yes' : 'No' }}
                        </td>
                        <td class="px-6 py-4">
                            @if($expense->isPaid())
                                <form action="{{ route('expense_payments.destroy', $expense->payments->first()) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-800 border border-green-300 hover:bg-green-200">
                                        Paid
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('expense_payments.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="expense_id" value="{{ $expense->id }}">
                                    <button type="submit" class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-800 border border-gray-300 hover:bg-gray-200">
                                        Mark as Paid
                                    </button>
                                </form>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm font-medium">
                            <a href="{{ route('expenses.edit', $expense) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                            <form method="POST" action="{{ route('expenses.destroy', $expense) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Delete this expense?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-500 italic">
                            No expenses found. Time to go shopping?
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
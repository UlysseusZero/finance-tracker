<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses - Finance Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8">
  <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">My Expenses</h1>
            <a href="{{ route('expenses.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Add Expense
            </a>
        </div>
    <div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
        <thead>
            <tr class="bg-gray-100 border-b">
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
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $expense->name }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $expense->category }}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-medium">
                        ₱{{ number_format($expense->amount, 2) }}
                    </td>
                    <td class="px-6 py-4 text-gray-500">
                        {{ $expense->due_day ?? 'N/A' }}
                    </td>
                    <td>
                      {{ $expense->is_recurring ? 'Yes - until ' . $expense->recurring_end_date : 'No' }}
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
                    <td class="px-6 py-4">
                        <a href="{{ route('expenses.edit', $expense) }}" 
                          class="text-blue-500 hover:text-blue-700 mr-3">Edit</a>
                        <form method="POST" action="{{ route('expenses.destroy', $expense) }}" 
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-500 hover:text-red-700"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                        No expenses found. Time to go shopping?
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>

</html>


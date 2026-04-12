<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Expense - Finance Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Expense</h1>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('expenses.update', $expense) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Name</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $expense->name) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Amount</label>
                <input
                    type="number"
                    name="amount"
                    step="0.01"
                    value="{{ old('amount', $expense->amount) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Category</label>
                <select
                    name="category"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">Select a category</option>
                    <option value="Loans" {{ old('category', $expense->category) == 'Loans' ? 'selected' : '' }}>Loans</option>
                    <option value="Electronics" {{ old('category', $expense->category) == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                    <option value="Utilities" {{ old('category', $expense->category) == 'Utilities' ? 'selected' : '' }}>Utilities</option>
                    <option value="Transportation" {{ old('category', $expense->category) == 'Transportation' ? 'selected' : '' }}>Transportation</option>
                    <option value="Food" {{ old('category', $expense->category) == 'Food' ? 'selected' : '' }}>Food</option>
                    <option value="Allowance" {{ old('category', $expense->category) == 'Allowance' ? 'selected' : '' }}>Allowance</option>
                    <option value="Subscriptions" {{ old('category', $expense->category) == 'Subscriptions' ? 'selected' : '' }}>Subscriptions</option>
                    <option value="Others" {{ old('category', $expense->category) == 'Others' ? 'selected' : '' }}>Others</option>
                </select>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-medium mb-1">Due Day</label>
                <input
                    type="number"
                    name="due_day"
                    min="1"
                    max="31"
                    value="{{ old('due_day', $expense->due_day) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-medium mb-1">Recurring</label>
                <input
                    type="hidden"
                    name="is_recurring"
                    value="0"
                >
                <input
                    type="checkbox"
                    name="is_recurring"
                    value="1"
                    {{ old('is_recurring', $expense->is_recurring) ? 'checked' : '' }}
                    class="h-4 w-4"
                >
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-medium mb-1">End Date</label>
                <input
                    type="date"
                    name="recurring_end_date"
                    value="{{ old('recurring_end_date', $expense->recurring_end_date ? $expense->recurring_end_date->format('Y-m-d') : '') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>
            <div class="flex gap-3 mt-6">
                <button
                    type="submit"
                    class="flex-1 bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition"
                >
                    Add
                </button>
                <a 
                    href="{{ url()->previous() }}" 
                    class="flex-1 text-center bg-red-600 text-white py-2 rounded hover:bg-red-700 transition"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</body>

<script>
    const recurring = document.querySelector('input[type="checkbox"][name="is_recurring"]');
    const endDate = document.querySelector('[name="recurring_end_date"]').closest('div');

    endDate.style.display = recurring.checked ? 'block' : 'none';

    recurring.addEventListener('change', function() {
        endDate.style.display = this.checked ? 'block' : 'none';
    });
</script>

</html>


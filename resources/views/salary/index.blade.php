<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary - Finance Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="w-full max-w-md">
    @if(session('success'))
          <div class="mb-4 p-3 bg-green-100 text-green-700 rounded border border-green-200">
              {{ session('success') }}
          </div>
    @endif
    @if($currentSalary)
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded">
            <p class="text-sm text-gray-600">Current Salary</p>
            <p class="text-2xl font-bold text-gray-800">₱{{ number_format($currentSalary->amount, 2) }}</p>
        </div>
    @endif
    <form action="{{ route('salary.store') }}" method="POST" class="bg-white p-6 rounded shadow">
      @csrf
      <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Monthly Salary Amount</label>
          <input 
              type="number" 
              name="amount" 
              step="0.01" 
              placeholder="0.00"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
              value="{{ old('amount', $currentSalary ? $currentSalary->amount : '') }}"
              required
          >
      </div>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          Save
      </button>
  </form>
  </div>
</body>
</html>
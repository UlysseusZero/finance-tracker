@extends('layouts.app')

@section('title', 'Salary - Finance Tracker')

@section('content')
  <div class="w-full max-w-md mx-auto">
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
@endsection
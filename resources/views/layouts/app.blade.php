<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Finance Tracker')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800 hover:text-blue-600">
            Finance Tracker
        </a>
        <div class="flex items-center gap-6">
            <div class="flex gap-4 text-sm font-medium">
                <a href="{{ route('expenses.index') }}" class="text-blue-600 hover:text-blue-800">Expenses</a>
                <a href="{{ route('salary.index') }}" class="text-blue-600 hover:text-blue-800">Salary</a>
            </div>
            <div class="h-6 w-px bg-gray-300"></div>
            <span class="text-gray-600">{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-500 hover:underline text-sm font-semibold">Logout</button>
            </form>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto mt-10 p-6">
        @if(session('success'))
            <div class="mb-6 p-3 bg-green-100 text-green-700 rounded border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
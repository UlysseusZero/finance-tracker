<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Finance Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-gray-800">Finance Tracker</h1>
        <div class="flex items-center gap-4">
            <span class="text-gray-600">{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-500 hover:underline text-sm">Logout</button>
            </form>
        </div>
    </nav>
    <div class="max-w-4xl mx-auto mt-10 p-6">
        <h2 class="text-2xl font-bold text-gray-800">Welcome, {{ Auth::user()->name }}!</h2>
        <p class="text-gray-500 mt-2">Your finance dashboard is coming soon.</p>
    </div>
</body>
</html>
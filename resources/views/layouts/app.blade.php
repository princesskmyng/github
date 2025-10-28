<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Transaction Processing</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800">

    {{-- Top Navigation Bar --}}
    <nav class="bg-blue-600 text-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <span class="text-xl font-semibold">☰ IT Transaction Processing</span>
            </div>
            <div class="hidden md:flex space-x-6 text-sm font-medium">
                <a href="{{ route('dashboard') }}" class="hover:underline flex items-center gap-1">🏠 Dashboard</a>
                <a href="{{ route('categories.index') }}" class="hover:underline flex items-center gap-1">📋 Categories</a>
                <a href="{{ route('assets.index') }}" class="hover:underline flex items-center gap-1">💼 Assets</a>
                <a href="{{ route('transactions.index') }}" class="hover:underline flex items-center gap-1">🔄 Transactions</a>
            </div>
        </div>
    </nav>

    {{-- Success Message --}}
    <div class="container mx-auto mt-6 px-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Main Page Content --}}
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="bg-blue-600 text-white mt-10">
        <div class="container mx-auto px-4 py-4 text-center text-sm">
            © {{ date('Y') }} IT Transaction Processing System — All Rights Reserved.
        </div>
    </footer>

</body>
</html>

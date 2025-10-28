@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Transactions</h1>
        <a href="{{ route('transactions.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + New Transaction
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Asset</th>
                <th class="border p-2">Category</th>
                <th class="border p-2">Details</th>
                <th class="border p-2">Created</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $t)
                <tr>
                    <td class="border p-2">{{ $t->asset->name ?? 'N/A' }}</td>
                    <td class="border p-2">{{ $t->asset->category->name ?? 'Uncategorized' }}</td>
                    <td class="border p-2">{{ $t->details }}</td>
                    <td class="border p-2">{{ $t->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center p-3">No transactions yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Transaction Details</h1>
        <a href="{{ route('transactions.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Back</a>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-gray-600 font-semibold mb-1">Transaction ID</label>
            <p class="text-lg">#{{ $transaction->id }}</p>
        </div>
        <div>
            <label class="block text-gray-600 font-semibold mb-1">Asset</label>
            <p class="text-lg">{{ $transaction->asset->name }}</p>
        </div>
        <div>
            <label class="block text-gray-600 font-semibold mb-1">Category</label>
            <p>{{ $transaction->asset->category->name }}</p>
        </div>
        <div>
            <label class="block text-gray-600 font-semibold mb-1">User</label>
            <p>{{ $transaction->user }}</p>
        </div>
        <div>
            <label class="block text-gray-600 font-semibold mb-1">Department</label>
            <p>{{ $transaction->department }}</p>
        </div>
        <div>
            <label class="block text-gray-600 font-semibold mb-1">Type</label>
            <span class="px-3 py-1 rounded text-sm text-white {{ $transaction->in_out == 'Out' ? 'bg-red-600' : 'bg-green-600' }}">
                {{ $transaction->in_out }}
            </span>
        </div>
        <div>
            <label class="block text-gray-600 font-semibold mb-1">Quantity</label>
            <p>{{ $transaction->quantity }}</p>
        </div>
        <div>
            <label class="block text-gray-600 font-semibold mb-1">Transaction Date</label>
            <p>{{ $transaction->transaction_date->format('M d, Y h:i A') }}</p>
        </div>
        <div>
            <label class="block text-gray-600 font-semibold mb-1">Created At</label>
            <p>{{ $transaction->created_at->format('M d, Y h:i A') }}</p>
        </div>
    </div>
</div>
@endsection
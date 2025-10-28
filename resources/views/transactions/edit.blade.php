{{-- resources/views/transactions/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Edit Transaction</h1>

    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Asset Selection --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Asset</label>
            <select name="asset_id" class="w-full border rounded px-3 py-2" required>
                <option value="">Select Asset</option>
                @foreach($assets as $asset)
                <option value="{{ $asset->id }}" {{ old('asset_id', $transaction->asset_id) == $asset->id ? 'selected' : '' }}>
                    {{ $asset->name }} - {{ $asset->category->name }}
                </option>
                @endforeach
            </select>
            @error('asset_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- User --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">User</label>
            <input type="text" name="user" class="w-full border rounded px-3 py-2" required value="{{ old('user', $transaction->user) }}">
            @error('user')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Department --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Department</label>
            <input type="text" name="department" class="w-full border rounded px-3 py-2" required value="{{ old('department', $transaction->department) }}">
            @error('department')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- In/Out --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">In/Out</label>
            <select name="in_out" class="w-full border rounded px-3 py-2" required>
                <option value="">Select Type</option>
                <option value="In" {{ old('in_out', $transaction->in_out) == 'In' ? 'selected' : '' }}>In</option>
                <option value="Out" {{ old('in_out', $transaction->in_out) == 'Out' ? 'selected' : '' }}>Out</option>
            </select>
            @error('in_out')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Quantity --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Quantity</label>
            <input type="number" name="quantity" class="w-full border rounded px-3 py-2" required min="1" value="{{ old('quantity', $transaction->quantity) }}">
            @error('quantity')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Transaction Date --}}
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Transaction Date</label>
            <input type="datetime-local" name="transaction_date" class="w-full border rounded px-3 py-2" required
                value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d\TH:i')) }}">
            @error('transaction_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Buttons --}}
        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update Transaction</button>
            <a href="{{ route('transactions.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">Cancel</a>
        </div>
    </form>
</div>
@endsection

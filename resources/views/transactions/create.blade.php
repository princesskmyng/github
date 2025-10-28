{{-- resources/views/transactions/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded p-6 mt-6">
    <h1 class="text-2xl font-bold mb-4">Create Transaction</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="asset_id" class="block font-medium text-gray-700 mb-2">Select Asset *</label>
            <select name="asset_id" id="asset_id" class="w-full border rounded p-2" required>
                <option value="">-- Select an Asset --</option>
                @foreach($assets as $asset)
                    <option value="{{ $asset->id }}" {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                        {{ $asset->name }} ({{ $asset->category->name ?? 'Uncategorized' }})
                    </option>
                @endforeach
            </select>
            @error('asset_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="user" class="block font-medium text-gray-700 mb-2">User Name *</label>
            <input type="text" name="user" id="user" value="{{ old('user') }}" 
                   class="w-full border rounded p-2" 
                   placeholder="Enter user name" required>
            @error('user')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="department" class="block font-medium text-gray-700 mb-2">Department *</label>
            <input type="text" name="department" id="department" value="{{ old('department') }}" 
                   class="w-full border rounded p-2" 
                   placeholder="Enter department" required>
            @error('department')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="in_out" class="block font-medium text-gray-700 mb-2">Transaction Type *</label>
            <select name="in_out" id="in_out" class="w-full border rounded p-2" required>
                <option value="">-- Select Type --</option>
                <option value="Out" {{ old('in_out') == 'Out' ? 'selected' : '' }}>Out (Assign Asset)</option>
                <option value="In" {{ old('in_out') == 'In' ? 'selected' : '' }}>In (Return Asset)</option>
            </select>
            @error('in_out')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="quantity" class="block font-medium text-gray-700 mb-2">Quantity *</label>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 1) }}" 
                   class="w-full border rounded p-2" 
                   min="1" required>
            @error('quantity')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="transaction_date" class="block font-medium text-gray-700 mb-2">Transaction Date *</label>
            <input type="datetime-local" name="transaction_date" id="transaction_date" 
                   value="{{ old('transaction_date', now()->format('Y-m-d\TH:i')) }}" 
                   class="w-full border rounded p-2" required>
            @error('transaction_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save Transaction
            </button>
            <a href="{{ route('transactions.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
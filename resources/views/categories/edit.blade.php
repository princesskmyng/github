@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Edit Category</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
            <label for="name" class="block text-gray-700 font-semibold mb-1">Category Name</label>
            <input type="text" id="name" name="name" 
                   value="{{ old('name', $category->name) }}" 
                   class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300" required>
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block text-gray-700 font-semibold mb-1">Status</label>
            <select id="status" name="status" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
                <option value="Active" {{ $category->status === 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ $category->status === 'Inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-gray-700 font-semibold mb-1">Description</label>
            <textarea id="description" name="description" rows="3" 
                      class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">{{ old('description', $category->description) }}</textarea>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-2">
            <a href="{{ route('categories.index') }}" 
               class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">
               Cancel
            </a>
            <button type="submit" 
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Update
            </button>
        </div>
    </form>
</div>
@endsection

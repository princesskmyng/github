@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Categories</h1>
        <a href="{{ route('categories.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Add Category
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-3 text-left">#</th>
                    <th class="border p-3 text-left">Category Name</th>
                    <th class="border p-3 text-left">Description</th>
                    <th class="border p-3 text-left">Created At</th>
                    <th class="border p-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="hover:bg-gray-50">
                        <td class="border p-3">{{ $loop->iteration }}</td>
                        <td class="border p-3">{{ $category->name }}</td>
                        <td class="border p-3">{{ $category->description }}</td>
                        <td class="border p-3">
                            {{-- Fix for "format() on string" error --}}
                            {{ \Carbon\Carbon::parse($category->created_at)->format('M d, Y') }}
                        </td>
                        <td class="border p-3 text-center space-x-2">
                            {{-- Fix for "stdClass cannot be converted to string" --}}
                            <a href="{{ route('categories.show', $category->id) }}" 
                               class="bg-cyan-500 text-white px-3 py-1 rounded text-sm hover:bg-cyan-600">
                                Show
                            </a>

                            <a href="{{ route('categories.edit', $category->id) }}" 
                               class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                Edit
                            </a>

                            <form action="{{ route('categories.destroy', $category->id) }}" 
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700"
                                        onclick="return confirm('Are you sure you want to delete this category?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border p-4 text-center text-gray-500">
                            No categories found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

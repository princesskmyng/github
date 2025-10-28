@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-4xl mx-auto">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Category Details</h1>
        <div class="flex space-x-2">
            <a href="{{ route('categories.edit', $category->id) }}" 
               class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
               Edit
            </a>
            <a href="{{ route('categories.index') }}" 
               class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition">
               Back
            </a>
        </div>
    </div>

    <!-- Category Info -->
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
            <label class="block text-gray-600 font-semibold mb-1">Name</label>
            <p class="text-lg">{{ $category->name ?? 'N/A' }}</p>
        </div>

        <div>
            <label class="block text-gray-600 font-semibold mb-1">Status</label>
            <span class="px-3 py-1 rounded text-sm text-white 
                {{ ($category->status ?? '') === 'Active' ? 'bg-green-600' : 'bg-gray-600' }}">
                {{ $category->status ?? 'Unknown' }}
            </span>
        </div>

        <div class="col-span-2">
            <label class="block text-gray-600 font-semibold mb-1">Description</label>
            <p>{{ $category->description ?? 'No description available.' }}</p>
        </div>

        <div>
            <label class="block text-gray-600 font-semibold mb-1">Created</label>
            <p>{{ \Carbon\Carbon::parse($category->created_at)->format('M d, Y h:i A') ?? 'N/A' }}</p>
        </div>

        <div>
            <label class="block text-gray-600 font-semibold mb-1">Last Updated</label>
            <p>{{ \Carbon\Carbon::parse($category->updated_at)->format('M d, Y h:i A') ?? 'N/A' }}</p>
        </div>
    </div>

    <!-- Assets Section -->
    <div class="border-t pt-4">
        <h3 class="font-bold text-lg mb-4">
            Assets in this Category ({{ $assets->count() }})
        </h3>

        @if($assets->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full border rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Name</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($assets as $asset)
                    <tr>
                        <td class="px-4 py-2 text-gray-800">{{ $asset->name }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded text-xs text-white 
                                {{ $asset->status === 'Active' ? 'bg-green-600' : 'bg-gray-600' }}">
                                {{ $asset->status }}
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            <a href="{{ route('assets.show', $asset->id) }}" 
                               class="bg-cyan-500 text-white px-3 py-1 rounded text-sm hover:bg-cyan-600 transition">
                               View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-gray-500 italic">No assets in this category yet.</p>
        @endif
    </div>
</div>
@endsection

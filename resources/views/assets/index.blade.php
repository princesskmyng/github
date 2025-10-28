@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">💼 Assets</h1>
        <a href="{{ route('assets.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add Asset</a>
    </div>

    <div class="flex space-x-2 mb-4 overflow-x-auto">
        <a href="{{ route('assets.index') }}" class="px-4 py-2 border rounded {{ !request('category') ? 'bg-blue-600 text-white' : 'bg-white text-gray-700' }}">
            ☰ All Categories
        </a>
        @foreach($categories as $cat)
        <a href="{{ route('assets.index', ['category' => $cat->id]) }}" class="px-4 py-2 border rounded whitespace-nowrap {{ request('category') == $cat->id ? 'bg-blue-600 text-white' : 'bg-white text-gray-700' }}">
            {{ $cat->name }}
        </a>
        @endforeach
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Category</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($assets as $asset)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $asset->name }}</td>
                    <td class="px-4 py-2">{{ $asset->category->name }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded text-xs text-white bg-green-600">{{ $asset->status }}</span>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex space-x-2">
                            <a href="{{ route('assets.show', $asset) }}" class="bg-cyan-500 text-white px-3 py-1 rounded text-sm hover:bg-cyan-600">Show</a>
                            <a href="{{ route('assets.edit', $asset) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">Edit</a>
                            <form action="{{ route('assets.destroy', $asset) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">No assets found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
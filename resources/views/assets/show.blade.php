@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-6">
    <h1 class="text-3xl font-bold mb-4 text-gray-800">{{ $asset->name }}</h1>

    <div class="space-y-3 text-gray-700">
        <p><strong>Status:</strong> 
            <span class="px-2 py-1 rounded 
                @if($asset->status == 'Available') bg-green-100 text-green-700 
                @elseif($asset->status == 'Assigned') bg-yellow-100 text-yellow-700 
                @else bg-red-100 text-red-700 @endif">
                {{ $asset->status }}
            </span>
        </p>

        <p><strong>Category:</strong> 
            {{ $asset->category->name ?? 'Uncategorized' }}
        </p>

        <p><strong>Created At:</strong> {{ $asset->created_at->format('F d, Y h:i A') }}</p>
        <p><strong>Updated At:</strong> {{ $asset->updated_at->format('F d, Y h:i A') }}</p>
    </div>

    <hr class="my-6">

    {{-- Related Assets Section --}}
    <div>
        <h2 class="text-xl font-semibold text-gray-800 mb-3">Other Assets in this Category</h2>

        @if($asset->category && $asset->category->assets && $asset->category->assets->count() > 1)
            <ul class="list-disc list-inside text-gray-700">
                @foreach($asset->category->assets as $related)
                    @if($related->id !== $asset->id)
                        <li>
                            <a href="{{ route('assets.show', $related->id) }}" class="text-blue-600 hover:underline">
                                {{ $related->name }}
                            </a> — <span class="text-sm text-gray-500">{{ $related->status }}</span>
                        </li>
                    @endif
                @endforeach
            </ul>
        @else
            <p class="text-gray-500 italic">No other assets in this category.</p>
        @endif
    </div>

    <div class="mt-6 flex space-x-3">
        <a href="{{ route('assets.edit', $asset->id) }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Edit</a>

        <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this asset?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
        </form>

        <a href="{{ route('assets.index') }}" 
           class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Back</a>
    </div>
</div>
@endsection

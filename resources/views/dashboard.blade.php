@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 px-6">
    <h2 class="text-3xl font-bold text-blue-700 mb-2 text-center">💼 IT Transaction Processing System</h2>
    <p class="text-gray-600 text-center mb-10">Welcome back! Here's an overview of your system activity.</p>

    {{-- Stats Section --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1 text-center">
            <div class="text-4xl mb-2 text-blue-600">📂</div>
            <h3 class="text-lg font-semibold text-gray-700">Categories</h3>
            <p class="text-3xl font-bold text-blue-700 mt-1">{{ $categoriesCount }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1 text-center">
            <div class="text-4xl mb-2 text-green-600">💻</div>
            <h3 class="text-lg font-semibold text-gray-700">Total Assets</h3>
            <p class="text-3xl font-bold text-green-700 mt-1">{{ $assetsCount }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1 text-center">
            <div class="text-4xl mb-2 text-indigo-500">🖥️</div>
            <h3 class="text-lg font-semibold text-gray-700">Available Assets</h3>
            <p class="text-3xl font-bold text-indigo-700 mt-1">{{ $availableAssets }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1 text-center">
            <div class="text-4xl mb-2 text-yellow-500">🔄</div>
            <h3 class="text-lg font-semibold text-gray-700">Transactions</h3>
            <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $transactionsCount }}</p>
        </div>
    </div>

    {{-- Quick Actions Section --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white p-6 rounded-2xl shadow hover:shadow-xl transition transform hover:-translate-y-1">
            <h4 class="text-xl font-semibold mb-2">➕ Add New Asset</h4>
            <p class="text-blue-100 mb-3">Register a new IT asset into the system.</p>
            <a href="{{ route('assets.create') }}" class="bg-white text-blue-600 font-semibold px-4 py-2 rounded-lg hover:bg-blue-50 transition inline-block">Add Asset</a>
        </div>

        <div class="bg-gradient-to-r from-green-600 to-green-400 text-white p-6 rounded-2xl shadow hover:shadow-xl transition transform hover:-translate-y-1">
            <h4 class="text-xl font-semibold mb-2">🗂️ Manage Categories</h4>
            <p class="text-green-100 mb-3">Create and organize asset categories.</p>
            <a href="{{ route('categories.index') }}" class="bg-white text-green-600 font-semibold px-4 py-2 rounded-lg hover:bg-green-50 transition inline-block">View Categories</a>
        </div>

        <div class="bg-gradient-to-r from-yellow-500 to-orange-400 text-white p-6 rounded-2xl shadow hover:shadow-xl transition transform hover:-translate-y-1">
            <h4 class="text-xl font-semibold mb-2">🔁 Process Transaction</h4>
            <p class="text-yellow-100 mb-3">Assign or return an asset easily.</p>
            <a href="{{ route('transactions.index') }}" class="bg-white text-yellow-600 font-semibold px-4 py-2 rounded-lg hover:bg-yellow-50 transition inline-block">Go to Transactions</a>
        </div>
    </div>

    {{-- Recent Activity Section --}}
    <div class="bg-white p-8 rounded-2xl shadow mb-8">
        <h3 class="text-2xl font-bold text-gray-700 mb-6 border-b pb-3">🕓 Recent Activity</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h4 class="font-semibold text-blue-700 mb-2">Recent Assets</h4>
                @if($recentAssets->isEmpty())
                    <p class="text-gray-500">No recent assets.</p>
                @else
                    <ul class="space-y-2">
                        @foreach($recentAssets as $asset)
                            <li class="bg-blue-50 px-4 py-2 rounded-lg">
                                <span class="font-medium">{{ $asset->name }}</span>
                                <span class="text-sm text-gray-500">({{ $asset->status }})</span>
                                <span class="text-xs text-gray-400 block">{{ $asset->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div>
                <h4 class="font-semibold text-yellow-600 mb-2">Recent Transactions</h4>
                @if($recentTransactions->isEmpty())
                    <p class="text-gray-500">No recent transactions.</p>
                @else
                    <ul class="space-y-2">
                        @foreach($recentTransactions as $transaction)
                            <li class="bg-yellow-50 px-4 py-2 rounded-lg">
                                <span class="font-medium">{{ $transaction->asset->name }}</span>
                                <span class="text-sm {{ $transaction->in_out == 'Out' ? 'text-red-600' : 'text-green-600' }}">
                                    ({{ $transaction->in_out }})
                                </span>
                                <span class="text-xs text-gray-400 block">by {{ $transaction->user }} - {{ $transaction->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
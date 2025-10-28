<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Asset;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('asset.category')->latest()->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $assets = Asset::with('category')->get();
        return view('transactions.create', compact('assets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'user' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'in_out' => 'required|in:In,Out',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date'
        ]);

        Transaction::create($validated);

        $asset = Asset::find($validated['asset_id']);
        if ($validated['in_out'] == 'Out') {
            $asset->update(['status' => 'Assigned']);
        } else {
            $asset->update(['status' => 'Available']);
        }

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction created successfully!');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('asset.category');
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $assets = Asset::with('category')->get();
        return view('transactions.edit', compact('transaction', 'assets'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'user' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'in_out' => 'required|in:In,Out',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date'
        ]);

        $transaction->update($validated);

        $asset = Asset::find($validated['asset_id']);
        if ($validated['in_out'] == 'Out') {
            $asset->update(['status' => 'Assigned']);
        } else {
            $asset->update(['status' => 'Available']);
        }

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction updated successfully!');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')
            ->with('success', 'Transaction deleted successfully!');
    }
}
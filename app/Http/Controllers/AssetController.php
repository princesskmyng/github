<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the assets.
     */
    public function index(Request $request)
    {
        // Fetch all categories for filter buttons
        $categories = Category::all();

        // Filter assets by category if category parameter exists
        $query = Asset::join('categories', 'assets.category_id', '=', 'categories.id')
            ->select('assets.*', 'categories.name as category_name');

        if ($request->has('category') && $request->category) {
            $query->where('assets.category_id', $request->category);
        }

        $assets = $query->get();

        return view('assets.index', compact('assets', 'categories'));
    }

    /**
     * Show the form for creating a new asset.
     */
    public function create()
    {
        $categories = Category::all();
        return view('assets.create', compact('categories'));
    }

    /**
     * Store a newly created asset in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|string|max:50',
        ]);

        Asset::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ]);

        return redirect()->route('assets.index')->with('success', 'Asset added successfully!');
    }

    /**
     * Display the specified asset.
     */
    public function show($id)
    {
        $asset = Asset::join('categories', 'assets.category_id', '=', 'categories.id')
            ->select('assets.*', 'categories.name as category_name')
            ->where('assets.id', $id)
            ->firstOrFail();

        return view('assets.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified asset.
     */
    public function edit($id)
    {
        $asset = Asset::findOrFail($id);
        $categories = Category::all();

        return view('assets.edit', compact('asset', 'categories'));
    }

    /**
     * Update the specified asset in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|string|max:50',
        ]);

        $asset = Asset::findOrFail($id);

        $asset->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ]);

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully!');
    }

    /**
     * Remove the specified asset from storage.
     */
    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully!');
    }
}

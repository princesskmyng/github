<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of all categories.
     */
    public function index()
    {
        $categories = DB::table('categories')->orderBy('created_at', 'desc')->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:500',
        ]);

        DB::table('categories')->insert([
            'name' => $request->name,
            'status' => $request->status ?? 'Active',
            'description' => $request->description ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category added successfully!');
    }

    /**
     * Display the specified category and its related assets.
     */
    public function show($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();

        if (!$category) {
            abort(404, 'Category not found');
        }

        // Fetch all assets belonging to this category
        $assets = DB::table('assets')
            ->where('category_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        // ✅ Pass both category and assets to the view
        return view('categories.show', compact('category', 'assets'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();

        if (!$category) {
            abort(404, 'Category not found');
        }

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:500',
        ]);

        $updated = DB::table('categories')->where('id', $id)->update([
            'name' => $request->name,
            'status' => $request->status ?? 'Active',
            'description' => $request->description ?? null,
            'updated_at' => now(),
        ]);

        if (!$updated) {
            return redirect()->back()->with('error', 'Failed to update category.');
        }

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy($id)
    {
        DB::table('categories')->where('id', $id)->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}

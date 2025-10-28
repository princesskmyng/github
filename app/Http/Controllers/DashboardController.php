<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Asset;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'categoriesCount' => Category::where('status', 'Active')->count(),
            'assetsCount' => Asset::count(),
            'availableAssets' => Asset::where('status', 'Available')->count(),
            'transactionsCount' => Transaction::count(),
            'recentAssets' => Asset::with('category')->latest()->take(5)->get(),
            'recentTransactions' => Transaction::with('asset')->latest()->take(5)->get()
        ];

        return view('dashboard', $data);
    }
}
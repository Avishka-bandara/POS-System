<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Product;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Apply filters here (date, month, year, product)
        $products = Product::all();
        $filters = $request->only(['date_range', 'month', 'year', 'product']);

        // Get data accordingly
        $totalSales = Sales::filtered($filters)->sum('grand_total');
        $totalOrders = Sales::filtered($filters)->count();
        $totalProducts = Product::count();
        // $totalCustomers = Customer::count();
        $topProducts = Product::withCount('sales')->orderByDesc('sales_count')->take(5)->get();
        $recentSales = Sales::latest()->take(10)->get();
        $needToRestock = Product::where('quantity', '<=', 5)->get();

        $chartLabels = []; // e.g. dates or months
        $chartData = []; // corresponding sales numbers

        return view('dashboard', compact(
            'totalSales',
            'totalOrders',
            'products',
            'totalProducts',
            // 'totalCustomers',
            'topProducts',
            'recentSales',
            'chartLabels',
            'chartData',
            'needToRestock'
        ));
    }
}

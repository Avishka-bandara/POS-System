<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;

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

        $sales = Sales::selectRaw('MONTH(created_at) as month, SUM(grand_total) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Convert for chart
        $chartLabels = $sales->pluck('month')->map(function ($m) {
            return date("M", mktime(0, 0, 0, $m, 1));
        });
        $chartData = $sales->pluck('total');

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

    public function chartData(Request $request)
    {   
        Log::info('Chart data request received', ['request' => $request->all()]);
        $filter = $request->get('filter', 'monthly');

        $query = Sales::query();

        switch ($filter) {
            case 'daily':
                $sales = $query->selectRaw('DATE(created_at) as date, SUM(grand_total) as total')
                    ->whereMonth('created_at', now()->month)
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();

                $labels = $sales->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d M'));
                break;

            case 'weekly':
                $sales = $query->selectRaw('WEEK(created_at) as week, SUM(grand_total) as total')
                    ->whereYear('created_at', now()->year)
                    ->groupBy('week')
                    ->orderBy('week')
                    ->get();

                $labels = $sales->pluck('week')->map(fn($w) => "Week {$w}");
                break;

            case 'yearly':
                $sales = $query->selectRaw('YEAR(created_at) as year, SUM(grand_total) as total')
                    ->groupBy('year')
                    ->orderBy('year')
                    ->get();

                $labels = $sales->pluck('year');
                break;

            case 'monthly':
            default:
                $sales = $query->selectRaw('MONTH(created_at) as month, SUM(grand_total) as total')
                    ->whereYear('created_at', now()->year)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();

                $labels = $sales->pluck('month')->map(fn($m) => date("M", mktime(0, 0, 0, $m, 1)));
                break;
        }

        $data = $sales->pluck('total');

        return response()->json([
            'labels' => $labels,
            'data'   => $data,
        ]);
    }
}
